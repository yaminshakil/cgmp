<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr Homayera Noor',
                'role' => 'Practice Principal',
                'qualifications' => 'MBBS, DCH, FRACGP',
                'bio' => 'Dr Homayera Noor is the Practice Principal at Cringila General Medical Practice, providing comprehensive general practice care to patients of all ages.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr Muhammad Iqbal',
                'role' => 'General Practitioner',
                'qualifications' => 'MBBS, Dip. Occup. Health & Safety (UOW), NSW Medical Acupuncture Course',
                'bio' => 'Dr Muhammad Iqbal is a General Practitioner at Cringila General Medical Practice with additional qualifications in occupational health and medical acupuncture.',
                'sort_order' => 2,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::query()->updateOrCreate(['name' => $doctor['name']], $doctor + ['is_active' => true]);
        }
    }
}
