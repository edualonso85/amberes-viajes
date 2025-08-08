<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aereos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id');
            $table->string('codigo_aereo');
            $table->string('proveedor');
            $table->string('origen');
            $table->string('destino');
            $table->date('fecha_salida');
            $table->date('fecha_llegada');
            $table->string('horario_salida');
            $table->string('horario_llegada');
            $table->decimal('monto_usd', 12, 2)->nullable();
            $table->decimal('monto_pesos', 12, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('aereos');
    }
};
