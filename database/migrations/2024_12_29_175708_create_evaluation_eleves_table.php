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
        Schema::create('evaluation_eleves', function (Blueprint $table) {
            $table->id();
            $table->float('note');
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            $table->foreignId('eleve_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_eleves');
    }
};
