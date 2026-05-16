<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->string('renter_name')->after('user_id');
            $table->dropForeign(['equipment_id']);
            $table->dropColumn('equipment_id');
        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn('renter_name');
            $table->foreignId('equipment_id')->constrained('equipments');
        });
    }
};
