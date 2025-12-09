<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // Run this in the terminal: php artisan make:migration add_slug_to_products_table --table=products

public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('slug')->unique()->after('name'); 
        $table->enum('status', ['active', 'inactive'])->default('active')->after('slug'); 
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('slug');
        $table->dropColumn('status');
    });
}

};
