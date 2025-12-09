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
        // Schema::create('prescription_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('prescription_id')->constrained('prescriptions')->onDelete('cascade'); // Prescription relation
        //     $table->foreignId('medical_id')->nullable()->constrained('medicals')->onDelete('set null'); // Medical relation
        //     $table->integer('quantity')->default(1); // Quantity prescribed
        //     $table->decimal('price', 10, 2); // Price of the medical item
        //     $table->timestamps();
        // });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('prescription_items');
    }
};
