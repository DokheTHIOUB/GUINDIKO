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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('articles_id');
            $table->string('nom');
            $table->string('telephone');
            $table->boolean('is_archived')->default(false);
            $table->string('email');
            $table->string('nombre_annee_experience');
            $table->integer('nombre_mentor');
            $table->string('password');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
