<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'General Practice',
                'slug' => 'general-practice',
                'icon' => 'stethoscope',
                'short_description' => 'Complete healthcare for all ages, from check-ups to acute care, with same-day appointments available.',
                'description' => 'Our GPs provide comprehensive care for every stage of life — routine check-ups, acute illness, vaccinations and referrals. Same-day appointments are available and walk-ins are welcome.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Mental Health Care',
                'slug' => 'mental-health-care',
                'icon' => 'brain',
                'short_description' => 'Supportive GP mental health care, mental health care plans and referrals to allied psychological services.',
                'description' => 'We provide compassionate mental health support, including Mental Health Care Plans and referrals to psychologists and allied health professionals.',
                'sort_order' => 2,
            ],
            [
                'title' => "Men's Health",
                'slug' => 'mens-health',
                'icon' => 'user-round',
                'short_description' => 'Health checks, preventive screening and management of conditions affecting men at every age.',
                'description' => "Confidential, judgement-free care covering preventive health checks, chronic condition management, and men's health screening.",
                'sort_order' => 3,
            ],
            [
                'title' => "Women's Health",
                'slug' => 'womens-health',
                'icon' => 'heart-pulse',
                'short_description' => 'Cervical screening, contraception, antenatal shared care, menopause support and more.',
                'description' => "Comprehensive women's health services including cervical screening, contraception advice, antenatal shared care, and menopause management.",
                'sort_order' => 4,
            ],
            [
                'title' => 'Chronic Disease Management',
                'slug' => 'chronic-disease-management',
                'icon' => 'activity',
                'short_description' => 'GP Management Plans and Team Care Arrangements for diabetes, asthma, heart disease and other ongoing conditions.',
                'description' => 'We help patients manage chronic conditions with structured GP Management Plans, Team Care Arrangements, and regular reviews.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Diabetes Care',
                'slug' => 'diabetes-care',
                'icon' => 'activity',
                'short_description' => 'Diagnosis, monitoring, medication reviews and lifestyle support for type 1 and type 2 diabetes.',
                'description' => 'Ongoing diabetes care including diagnosis, blood glucose monitoring, medication reviews, and lifestyle and dietary support.',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service + ['is_active' => true]);
        }
    }
}
