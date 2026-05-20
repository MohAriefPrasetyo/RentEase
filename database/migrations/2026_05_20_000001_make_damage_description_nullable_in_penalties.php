<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penalties', function (Blueprint $table) {
            $table->text('damage_description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penalties', function (Blueprint $table) {
            $table->text('damage_description')->nullable(false)->change();
        });
    }
};
