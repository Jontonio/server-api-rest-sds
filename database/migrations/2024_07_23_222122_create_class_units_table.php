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
        Schema::create('class_units', function (Blueprint $table) {
            $table->increments('id_class_unit');
            $table->string('class_unit_title', 150);
            $table->string('class_unit_description', 300);
            $table->string('class_unit_file_url', 200);
            $table->string('status',1)->default(true);
            $table->unsignedInteger('id_teacher_area');
            $table->foreign('id_teacher_area')->references('id_teacher_area')->on('teacher_areas');
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
        Schema::dropIfExists('class_units');
    }
};
