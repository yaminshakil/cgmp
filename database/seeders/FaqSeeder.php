<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Do you offer bulk billing?',
                'answer' => 'Billing varies by consultation type. Please ask our reception team about bulk billing and Medicare rebates when you book your appointment.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How do I book an appointment?',
                'answer' => 'Book online using the "Book Appointment" button, which links to our HealthEngine booking page, or call the practice directly. Walk-ins are also welcome.',
                'sort_order' => 2,
            ],
            [
                'question' => 'What should I bring to my first appointment?',
                'answer' => 'Please bring your Medicare card, photo ID, a list of current medications, and any relevant referrals or test results.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Do you speak languages other than English?',
                'answer' => 'Please contact reception to check current language support and interpreter availability for your appointment.',
                'sort_order' => 4,
            ],
            [
                'question' => 'What happens if I need care after hours?',
                'answer' => 'For non-emergency care outside our opening hours, you can contact the National Home Doctor Service on 13 SICK (13 74 25) or visit your nearest urgent care clinic. For a medical emergency, always call 000.',
                'sort_order' => 5,
            ],
            [
                'question' => 'Can I get a referral to a specialist?',
                'answer' => 'Yes. Book a standard consultation with one of our GPs, who can assess your needs and provide a referral to a specialist if clinically appropriate.',
                'sort_order' => 6,
            ],
        ];

        $keep = collect($faqs)->pluck('question');
        Faq::query()->whereNotIn('question', $keep)->delete();

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(['question' => $faq['question']], $faq + ['is_active' => true]);
        }
    }
}
