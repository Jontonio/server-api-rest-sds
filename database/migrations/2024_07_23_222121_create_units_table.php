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
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id_unit');
            $table->string('unit_name', 20)->nullable();
            $table->string('unit_description', 350)->nullable();
            $table->date('unit_start');
            $table->date('unit_finish');
            $table->string('status')->default(true);
            $table->unsignedInteger('id_academic_program');
            $table->foreign('id_academic_program')->references('id_academic_program')->on('academic_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
