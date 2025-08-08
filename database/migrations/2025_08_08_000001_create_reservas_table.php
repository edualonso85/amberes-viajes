<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('vendedor_id');
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('vendedor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
