<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        Section::store('hero', [
            'heading' => 'Personalised Support for All Your Healthcare Needs',
            'subheading' => 'Trusted, compassionate general practice in the heart of Cringila. Expert care for every member of your family — from routine check-ups to complex health needs.',
            'badge_text' => 'Cringila General Medical Practice',
            'primary_button_text' => 'Book Appointment',
            'primary_button_link' => '/book-appointment',
            'secondary_button_text' => 'Our Services',
            'secondary_button_link' => '/services',
            'review_rating' => '5.0',
            'review_count' => '1600+',
            'video_url' => null,
            'image' => null,
        ]);

        Section::store('about', [
            'heading' => 'Caring for Cringila Since 2026',
            'subheading' => 'We are a passionate team of GPs dedicated to providing exceptional healthcare to our community.',
            'body' => '<p>Our experienced team offers comprehensive general practice care for individuals and families at every stage of life. We are open five days a week, with same-day appointments available and walk-ins welcome.</p><p>Our GPs specialise in mental health, men\'s and women\'s health, and chronic disease management.</p>',
            'image' => 'images/about-consultation.jpg',
            'points' => [
                'Open five days a week',
                'Same-day appointments available',
                'Walk-ins welcome',
            ],
            'stats' => [
                ['value' => 2, 'suffix' => '', 'label' => 'GPs'],
                ['value' => 5, 'suffix' => '', 'label' => 'Days a week'],
            ],
        ]);

        Section::store('booking_strip', [
            'heading' => 'Ready to see a doctor?',
            'text' => 'Book online in minutes with HealthEngine, call the practice, or simply walk in.',
            'button_text' => 'Book online with HealthEngine',
        ]);
    }
}
