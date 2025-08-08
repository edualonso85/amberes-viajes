<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('terrestres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id');
            $table->string('proveedor');
            $table->string('descripcion_corta');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->decimal('precio_usd', 12, 2)->nullable();
            $table->decimal('precio_pesos', 12, 2)->nullable();
            $table->timestamps();
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('terrestres');
    }
};
