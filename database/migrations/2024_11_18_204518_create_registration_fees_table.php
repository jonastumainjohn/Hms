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
        Schema::create('registration_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('fee_amount', 10, 2);  // Registration fee amount, with 2 decimal places
            $table->string('currency', 5);  // Currency code (e.g., USD, EUR, TZS)
            $table->date('valid_from');  // Start date of the registration fee
            $table->date('valid_until');  // End date of the registration fee
            $table->text('description')->nullable();  // Optional description for the fee
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_fees');
    }
};
