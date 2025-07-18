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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 8, 2);
            $table->integer('stock');
            $table->decimal('precisal', 8, 2);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            //la columna puede estar -> vacia nullable()
            //se relaciona con la tabla user ->constrained()
            //si se elimina el usuario el campo queda en null y NO elimina los productos de ese usuario->onDelete('set null');
            //y si se pone en ->onDelete('cascade'); automaticamente se elimina tambien producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
