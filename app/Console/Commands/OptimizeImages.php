<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--dry-run : Show what would change without touching any file}';

    protected $description = 'Shrink oversized uploaded images (services, posts, doctors, gallery, sections) to speed up page loads';

    /** Folder => widest the image ever needs to be on the site. */
    private const MAX_WIDTH = [
        'services' => 1200,
        'posts' => 1200,
        'doctors' => 800,
        'gallery' => 1200,
        'sections' => 1600,
    ];

    public function handle(): int
    {
        $disk = Storage::disk('public');
        $manager = new ImageManager(new Driver);
        $saved = 0;

        foreach (self::MAX_WIDTH as $folder => $maxWidth) {
            foreach ($disk->files($folder) as $path) {
                if (! preg_match('/\.jpe?g$/i', $path)) {
                    continue;
                }

                $before = $disk->size($path);
                $image = $manager->read($disk->path($path));

                // Skip files that are already small enough in both dimensions and weight.
                if ($image->width() <= $maxWidth && $before < 150_000) {
                    continue;
                }

                $encoded = (string) $image->scaleDown(width: $maxWidth)->toJpeg(quality: 78);
                $after = strlen($encoded);

                if ($after >= $before) {
                    continue;
                }

                $this->line(sprintf('%s  %s → %s', $path, $this->kb($before), $this->kb($after)));

                if (! $this->option('dry-run')) {
                    $disk->put($path, $encoded);
                }

                $saved += $before - $after;
            }
        }

        $this->info(($this->option('dry-run') ? 'Would save ' : 'Saved ') . $this->kb($saved) . '.');

        return self::SUCCESS;
    }

    private function kb(int $bytes): string
    {
        return round($bytes / 1024) . ' KB';
    }
}
