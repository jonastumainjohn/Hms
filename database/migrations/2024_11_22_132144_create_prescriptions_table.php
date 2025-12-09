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
    Schema::create('prescription', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Patient relation
        $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null'); // Doctor relation
        $table->text('description')->nullable(); // Additional notes
        $table->decimal('total_price', 10, 2)->default(0); // Total cost
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription');
    }
};
