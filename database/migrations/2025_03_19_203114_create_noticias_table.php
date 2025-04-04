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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('fecha_publicacion');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->foreignId('genero_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade'); 
          /*   $table->morphs('noticiaable'); */
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
