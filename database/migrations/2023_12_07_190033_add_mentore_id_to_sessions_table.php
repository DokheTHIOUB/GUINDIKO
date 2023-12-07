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
        Schema::table('sessions', function (Blueprint $table) {
            
            $table->unsignedBigInteger('mentore_id')->after('id');
 
            $table->foreign('mentore_id')->references('id')->on('mentores')
             ->constrained()
             ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            
            $table->dropForeign(['mentore_id']);
            $table->dropColumn('mentore_id');
        });
    }
};
