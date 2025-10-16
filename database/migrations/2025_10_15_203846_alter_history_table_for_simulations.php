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
        Schema::table('history', function (Blueprint $table) {
            $table->integer('total_questions')->after('category_id')->nullable();
            $table->integer('correct_answers')->after('total_questions')->nullable();
            $table->boolean('passed')->after('correct_answers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history', function (Blueprint $table) {
            $table->dropColumn([
                'total_questions',
                'correct_answers',
                'passed',
            ]);

        });
    }
};
