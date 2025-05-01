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
        Schema::create('verkooptransactie', function (Blueprint $table) {
            $table->id();
            $table->decimal('totaalbedrag', 10, 2);
            $table->string('betaal_methode', 50);
            $table->timestamp('transactie_tijd')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verkooptransactie');
    }
};
