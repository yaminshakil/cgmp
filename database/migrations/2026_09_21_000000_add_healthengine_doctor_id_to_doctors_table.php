<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('healthengine_doctor_id')->nullable()->after('availability_days');
        });

        // HealthEngine practitioner IDs for the practice's current doctors (matched by name).
        foreach (['Homayera Noor' => 118736, 'Hasina Muttaqi' => 129147, 'Hamze Hamze' => 142301] as $name => $id) {
            DB::table('doctors')->where('name', 'like', "%{$name}%")->update(['healthengine_doctor_id' => $id]);
        }
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('healthengine_doctor_id');
        });
    }
};
