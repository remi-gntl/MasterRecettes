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
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('ingredients');
            $table->text('instructions');
            $table->integer('temps_preparation')->nullable();
            $table->integer('temps_cuisson')->nullable();  
            $table->integer('portions')->nullable();    
            $table->string('difficulte')->nullable();
            $table->string('image')->nullable();   
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recettes');
    }
};
