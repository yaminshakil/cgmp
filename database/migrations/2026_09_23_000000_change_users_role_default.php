<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The role column defaulted to 'admin', so any user row created without an explicit
     * role (e.g. a factory, a future signup path) silently became a full admin. Every real
     * admin/manager account is already created with an explicit role, so this only tightens
     * the default for rows that don't set one.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('admin')->change();
        });
    }
};
