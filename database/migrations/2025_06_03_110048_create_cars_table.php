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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->year('year');
            $table->string('chasis_number')->unique()->nullable();
            $table->string('numberplate')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('fuel', ['gasoline', 'diesel', 'electric', 'hybrid/diesel', 'hybrid/gasoline', 'hydrogen']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
