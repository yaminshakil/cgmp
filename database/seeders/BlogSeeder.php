<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $clinicUpdates = Category::query()->updateOrCreate(['slug' => 'clinic-updates'], ['name' => 'Clinic Updates']);
        $healthAdvice = Category::query()->updateOrCreate(['slug' => 'health-advice'], ['name' => 'Health Advice']);

        $author = User::query()->first();

        $posts = [
            [
                'category_id' => $clinicUpdates->id,
                'title' => 'Respiratory Symptoms? Please Wear a Mask When Visiting',
                'slug' => 'respiratory-symptoms-mask-notice',
                'excerpt' => 'To keep vulnerable patients safe, we kindly ask anyone with cough, cold or flu symptoms to wear a face mask while in the practice.',
                'body' => '<p>If you are experiencing acute respiratory symptoms such as a cough, cold or flu, please wear a face mask while in the practice. Masks are available at reception.</p><p>This helps protect our vulnerable patients, including young children, elderly patients, and those with chronic health conditions.</p>',
                'featured_image' => 'images/blog/blog-mask-notice.jpg',
                'featured_image_alt' => 'Doctor wearing a face mask and stethoscope',
                'status' => 'published',
                'published_at' => now()->subDays(9),
            ],
            [
                'category_id' => $healthAdvice->id,
                'title' => 'Diabetes Awareness: Know Your Risk',
                'slug' => 'diabetes-awareness-know-your-risk',
                'excerpt' => 'Around 1.3 million Australians live with diabetes and many more don\'t know they\'re at risk. Here\'s what to watch for and when to get checked.',
                'body' => '<p>Diabetes is one of the most common chronic conditions in Australia. Early diagnosis and management can significantly reduce the risk of complications.</p><p>Speak to your GP about a diabetes risk assessment, especially if you have a family history, are overweight, or are over 40.</p>',
                'featured_image' => 'images/blog/blog-diabetes-awareness.jpg',
                'featured_image_alt' => 'Healthcare worker holding a blood glucose meter',
                'status' => 'published',
                'published_at' => now()->subDays(18),
            ],
            [
                'category_id' => $clinicUpdates->id,
                'title' => 'Same-Day Appointments & Walk-Ins: How Our Clinic Works',
                'slug' => 'same-day-appointments-and-walk-ins',
                'excerpt' => 'Open five days a week with same-day appointments and walk-ins welcome — here\'s how to be seen quickly at CGMP.',
                'body' => '<p>Cringila General Medical Practice is open five days a week. We offer same-day appointments subject to availability, and walk-ins are always welcome.</p><p>For the fastest service, we recommend booking online via HealthEngine or calling ahead.</p>',
                'featured_image' => 'images/blog/blog-same-day-appointments.jpg',
                'featured_image_alt' => 'Modern medical clinic reception area',
                'status' => 'published',
                'published_at' => now()->subDays(27),
            ],
            [
                'category_id' => $clinicUpdates->id,
                'title' => 'Now Booking Online via HealthEngine',
                'slug' => 'now-booking-online-via-healthengine',
                'excerpt' => 'You can now book your appointment with us anytime, day or night, through HealthEngine — no phone call required.',
                'body' => '<p>We\'re making it easier than ever to see your GP. Appointments can now be booked online through HealthEngine directly from our website, any time of day.</p><p>Prefer to speak to someone? Reception is still happy to book over the phone during opening hours.</p>',
                'featured_image' => 'images/blog/blog-online-booking.jpg',
                'featured_image_alt' => 'Healthcare professional using a smartphone and tablet',
                'status' => 'published',
                'published_at' => now()->subDays(4),
            ],
            [
                'category_id' => $healthAdvice->id,
                'title' => 'Flu Vaccination Season: What You Need to Know',
                'slug' => 'flu-vaccination-season',
                'excerpt' => 'Flu season is approaching — here\'s who should get vaccinated, when, and how to book your shot at CGMP.',
                'body' => '<p>Annual flu vaccination is recommended for everyone aged six months and older, and is especially important for young children, pregnant women, people aged 65 and over, and those with chronic health conditions.</p><p>Book an appointment with your GP to get vaccinated before flu season peaks.</p>',
                'featured_image' => 'images/blog/blog-flu-vaccination.jpg',
                'featured_image_alt' => 'Doctor administering a vaccination',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => $post['slug']],
                $post + ['author_id' => $author?->id]
            );
        }
    }
}
