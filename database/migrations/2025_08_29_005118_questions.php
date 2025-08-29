<?php

use App\SimulatedType;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('type', array_map(fn($case) => $case->value, SimulatedType::cases()))
                ->default(SimulatedType::TEORICO->value);
            $table->json('images')->nullable();
            $table->json('video')->nullable();
            $table->boolean('common_mistakes')->default(false);
            $table->timestamps();
            $table->index(['category_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
