<?php

namespace App\Support;

class TextStyles
{
    /**
     * Ordered small -> large. Order matters: the admin stepper walks this array.
     */
    public const SIZES = [
        'xs' => '0.75rem',
        'sm' => '0.875rem',
        'base' => '1rem',
        'lg' => '1.125rem',
        'xl' => '1.25rem',
        '2xl' => '1.5rem',
        '3xl' => '1.875rem',
        '4xl' => '2.25rem',
        '5xl' => '3rem',
    ];

    public const FONTS = [
        '' => 'Theme default',
        'serif' => 'Serif (Fraunces)',
        'sans' => 'Sans (Aileron)',
        'georgia' => 'Georgia',
        'arial' => 'Arial',
        'verdana' => 'Verdana',
        'mono' => 'Monospace',
    ];

    protected const FONT_STACKS = [
        'serif' => "'Fraunces', ui-serif, Georgia, serif",
        'sans' => "'Aileron', ui-sans-serif, system-ui, sans-serif",
        'georgia' => "Georgia, 'Times New Roman', serif",
        'arial' => "Arial, Helvetica, sans-serif",
        'verdana' => "Verdana, Geneva, sans-serif",
        'mono' => "'Courier New', Courier, monospace",
    ];

    /**
     * Build an inline `style` attribute value for a single field's style entry
     * (e.g. ['size' => 'xl', 'font' => 'serif']). Returns '' when there's nothing to override.
     */
    public static function css(?array $style): string
    {
        if (empty($style)) {
            return '';
        }

        $decls = [];

        if (! empty($style['size']) && isset(self::SIZES[$style['size']])) {
            $decls[] = 'font-size:' . self::SIZES[$style['size']];
        }

        if (! empty($style['font']) && isset(self::FONT_STACKS[$style['font']])) {
            $decls[] = 'font-family:' . self::FONT_STACKS[$style['font']];
        }

        return implode(';', $decls);
    }

    /**
     * Clean up one field's raw form input (['size' => ..., 'font' => ...]) down to
     * only recognised values, or null when there's no override to store.
     */
    public static function sanitize(?array $input): ?array
    {
        if (empty($input)) {
            return null;
        }

        $size = $input['size'] ?? null;
        $font = $input['font'] ?? null;

        $size = ($size && isset(self::SIZES[$size])) ? $size : null;
        $font = ($font && isset(self::FONT_STACKS[$font])) ? $font : null;

        if (! $size && ! $font) {
            return null;
        }

        return array_filter(['size' => $size, 'font' => $font]);
    }

    /**
     * Sanitize a whole `text_styles[...]` form array down to a clean field => style map,
     * restricted to the given known field names.
     */
    public static function sanitizeAll(array $rawStyles, array $fields): array
    {
        $out = [];

        foreach ($fields as $field) {
            $clean = self::sanitize($rawStyles[$field] ?? null);
            if ($clean) {
                $out[$field] = $clean;
            }
        }

        return $out;
    }
}
