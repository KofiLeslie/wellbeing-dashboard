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
        Schema::table('physical_healths', function (Blueprint $table) {
            $table->enum('age_group', ['OLD', 'YOUNG'])->default('YOUNG');
            $table->string("question_group")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('physical_healths', function (Blueprint $table) {
            $table->dropColumn(['age_group', 'question_group']);
        });
    }
};
