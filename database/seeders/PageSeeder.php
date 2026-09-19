<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Fees & Information',
                'slug' => 'fees-info',
                'body' => '<p>We believe healthcare should be accessible and easy to understand. Please speak with our reception team about billing, Medicare rebates, and any out-of-pocket costs before your appointment.</p>',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'body' => '<p>Cringila General Medical Practice is committed to protecting your privacy in accordance with the Australian Privacy Principles. This page will be updated with our full privacy policy.</p>',
            ],
            [
                'title' => 'Terms of Use',
                'slug' => 'terms',
                'body' => '<p>This page will be updated with the full terms of use for this website.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
