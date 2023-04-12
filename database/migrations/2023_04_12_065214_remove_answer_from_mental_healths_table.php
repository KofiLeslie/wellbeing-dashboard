<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $dbs_tables = ['mental_healths', 'physical_healths', 'social_wellbeings', 'emotional_healths'];
        for ($i = 0; $i < 4; $i++) {
            Schema::table($dbs_tables[$i], function (Blueprint $table) {
                $table->dropColumn('answer');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $dbs_tables = ['mental_healths', 'physical_healths', 'social_wellbeings', 'emotional_healths'];
        for ($i = 0; $i < 4; $i++) {
            Schema::table($dbs_tables[$i], function (Blueprint $table) {
                $table->integer('answer')->nullable();
            });
        }
    }
};
