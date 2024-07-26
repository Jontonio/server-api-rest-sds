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
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->increments('id_academic_program');
            $table->string('academic_program_bim',4);
            $table->dateTime('academic_program_start');
            $table->dateTime('academic_program_finish');
            $table->string('status',1)->default(true);
            $table->string('modular_code',8);
            $table->foreign('modular_code')->references('modular_code')->on('institutions');
            $table->unsignedInteger('id_academic_calendar');
            $table->foreign('id_academic_calendar')->references('id_academic_calendar')->on('academic_calendars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_programs');
    }
};
