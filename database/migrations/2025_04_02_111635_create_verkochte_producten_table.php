<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('verkochte_producten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactie_id')->nullable()->constrained('verkooptransactie')->onDelete('set null');
            $table->foreignId('product_id')->nullable()->constrained('producten')->onDelete('set null');
            $table->integer('aantal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verkochte_producten');
    }
};
