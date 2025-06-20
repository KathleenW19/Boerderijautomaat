<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gebruikers', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('password');
            $table->string('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gebruikers');
    }
};
