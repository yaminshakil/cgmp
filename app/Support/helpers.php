<?php

use App\Models\Section;
use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('section_data')) {
    function section_data(string $key, array $default = []): array
    {
        return Section::data($key, $default);
    }
}

if (! function_exists('image_url')) {
    function image_url(?string $path, string $fallback = ''): string
    {
        if ($path && str_starts_with($path, 'http')) {
            return $path;
        }

        if ($path && str_starts_with($path, 'images/')) {
            return asset($path);
        }

        if ($path && trim($path) !== '') {
            return asset('storage/' . ltrim($path, '/'));
        }

        return $fallback !== '' ? asset($fallback) : '';
    }
}

if (! function_exists('booking_url')) {
    function booking_url(): string
    {
        return setting('healthengine_url') ?: route('booking');
    }
}

if (! function_exists('booking_is_external')) {
    function booking_is_external(): bool
    {
        return (bool) setting('healthengine_url');
    }
}

if (! function_exists('text_style')) {
    /**
     * Inline `style` attribute value for an admin-configurable text field.
     * $styles is a field-name => ['size' => ..., 'font' => ...] map (a model's
     * text_styles column, or a section's content['styles']).
     */
    function text_style(?array $styles, string $field): string
    {
        return \App\Support\TextStyles::css($styles[$field] ?? null);
    }
}

if (! function_exists('opening_hours_status')) {
    /**
     * Parse the free-text `opening_hours` setting and report today's status.
     * Supports lines such as "Sunday - Friday: 8:30am - 5:30pm" and "Saturday: Closed".
     *
     * @return array{label: string, variant: 'open'|'closed', is_open_day: bool, is_open_now: bool, hours: string}
     */
    function opening_hours_status(): array
    {
        $dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $dayIndex = array_flip($dayNames);
        $aliases = ['sun' => 0, 'mon' => 1, 'tue' => 2, 'wed' => 3, 'thu' => 4, 'fri' => 5, 'sat' => 6];

        $today = now()->dayOfWeek; // 0 = Sunday ... 6 = Saturday
        $schedule = [];

        $applyHours = function (int $day, array $entry) use (&$schedule): void {
            $schedule[$day] = $entry;
        };

        foreach (preg_split('/\r\n|\r|\n/', (string) setting('opening_hours', '')) as $line) {
            $line = trim($line);
            if ($line === '' || ! preg_match('/^([^:]+):\s*(.+)$/', $line, $m)) {
                continue;
            }

            $hours = trim($m[2]);
            $isClosed = (bool) preg_match('/closed/i', $hours);

            $start = 0;
            $end = 24 * 60;
            if (! $isClosed && ! preg_match('/24\s*hours|open\s*24/i', $hours)) {
                $times = preg_split('/\s*(?:-|–|—|to)\s*/i', $hours);
                $parsedStart = isset($times[0]) ? parse_opening_time($times[0]) : null;
                $parsedEnd = isset($times[1]) ? parse_opening_time($times[1]) : null;
                $start = $parsedStart ?? 0;
                $end = $parsedEnd ?? (24 * 60);
            }

            $entry = [
                'closed' => $isClosed,
                'hours' => $hours,
                'start' => $start,
                'end' => $end,
            ];

            // Split comma/& separated groups, then treat "A - B" as a circular day range.
            $groups = preg_split('/\s*(?:,|&)\s*/i', trim($m[1]));
            foreach ($groups as $group) {
                $parts = preg_split('/\s*(?:-|–|—|to)\s*/i', trim($group));
                $idxs = [];
                foreach ($parts as $part) {
                    $part = trim($part);
                    $key = $dayIndex[$part] ?? $aliases[strtolower(substr($part, 0, 3))] ?? null;
                    if ($key !== null) {
                        $idxs[] = $key;
                    }
                }
                $idxs = array_values(array_unique($idxs));
                if (count($idxs) === 0) {
                    continue;
                }
                if (count($idxs) === 1) {
                    $applyHours($idxs[0], $entry);
                    continue;
                }
                // Day range: assign every day from the first to the last (wrapping the week).
                $i = $idxs[0];
                $last = end($idxs);
                while (true) {
                    $applyHours($i, $entry);
                    if ($i === $last) {
                        break;
                    }
                    $i = ($i + 1) % 7;
                }
            }
        }

        $todayEntry = $schedule[$today] ?? null;
        $isOpenDay = $todayEntry !== null && ! $todayEntry['closed'];
        $nowMinutes = now()->hour * 60 + now()->minute;
        $isOpenNow = $isOpenDay && $todayEntry['start'] <= $nowMinutes && $nowMinutes < $todayEntry['end'];

        $until = '';
        if ($isOpenDay && $todayEntry['start'] !== $todayEntry['end']) {
            $until = trim(explode('-', str_replace(['–', '—'], '-', $todayEntry['hours']), 2)[1] ?? '');
        }
        if (preg_match('/24\s*hours|open\s*24/i', $todayEntry['hours'] ?? '')) {
            $until = '';
        }

        if ($isOpenNow && $until !== '') {
            $label = 'Open now · closes ' . $until;
        } elseif ($isOpenNow) {
            $label = 'Open now';
        } elseif ($isOpenDay) {
            $label = 'Open today · ' . ($todayEntry['hours'] ?? '');
        } else {
            $label = 'Closed today';
        }

        return [
            'label' => $label,
            'variant' => $isOpenDay ? 'open' : 'closed',
            'is_open_day' => $isOpenDay,
            'is_open_now' => $isOpenNow,
            'hours' => $todayEntry['hours'] ?? '',
        ];
    }
}

if (! function_exists('parse_opening_time')) {
    function parse_opening_time(string $time): ?int
    {
        $time = strtolower(trim($time));
        if (! preg_match('/^(\d{1,2})(?::(\d{2}))?\s*(am|pm)?$/', $time, $m)) {
            return null;
        }
        $hour = (int) $m[1];
        $minute = (int) ($m[2] ?? 0);
        $suffix = $m[3] ?? '';
        if ($suffix === 'pm' && $hour < 12) {
            $hour += 12;
        }
        if ($suffix === 'am' && $hour === 12) {
            $hour = 0;
        }
        if ($suffix === '') {
            // Bare hours like "9" are treated as times; keep 0-23 as-is.
            $hour = $hour === 0 ? 12 : $hour;
        }

        return $hour * 60 + $minute;
    }
}
