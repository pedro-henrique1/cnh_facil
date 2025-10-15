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
            $table->time('time_spent')->change();
            if (Schema::hasColumn('history', 'question_id')) {
                $table->dropForeign(['question_id']);
                $table->dropColumn('question_id');
            }

            if (Schema::hasColumn('history', 'category_id')) {
                // Remova a chave estrangeira (se existir)
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('history', function (Blueprint $table) {
            $table->integer('time_spent')->change();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

        });
    }
};
