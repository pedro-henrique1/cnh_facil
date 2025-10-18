<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'id_question')) {
                $table->uuid('id_question')->unique()->nullable();
            }
        });

        $questions = \Illuminate\Support\Facades\DB::table('questions')
            ->whereNull('id_question')
            ->get();

        foreach ($questions as $question) {
            \Illuminate\Support\Facades\DB::table('questions')
                ->where('id', $question->id)
                ->update(['id_question' => (string) Str::uuid()]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            if (Schema::hasColumn('questions', 'id_question')) {
                $table->dropColumn('id_question');
            }
        });
    }
};
