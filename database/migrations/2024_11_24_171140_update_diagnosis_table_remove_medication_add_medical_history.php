<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            // Remove medication column
            $table->dropColumn('medication');
            
            // Add medical_history column
            $table->text('medical_history')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            // Rollback changes
            $table->text('medication')->nullable();
            $table->dropColumn('medical_history');
        });
    }
    
};
