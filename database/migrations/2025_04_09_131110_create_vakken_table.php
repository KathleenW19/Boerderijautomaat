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
        Schema::create('vakken', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('producten')->onDelete('set null');  // Verwijst naar een product
            $table->foreignId('vak_type_id')->constrained('vak_types')->onDelete('cascade');  // Verwijst naar het type vak
            $table->string('status')->default('leeg');  // Dit kan 'leeg', 'bezet' of 'vak geopend' zijn.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vakken');
    }
};
