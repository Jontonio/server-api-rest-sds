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
        Schema::create('teacher_areas', function (Blueprint $table) {
            $table->increments('id_teacher_area');
            $table->string('status',1)->default(true);
            $table->unsignedInteger('id_ie_teacher');
            $table->foreign('id_ie_teacher')->references('id_ie_teacher')->on('institution_teachers');
            $table->unsignedInteger('id_area');
            $table->foreign('id_area')->references('id_area')->on('areas');
            $table->unsignedInteger('id_grade');
            $table->foreign('id_grade')->references('id_grade')->on('grades');
            $table->unsignedInteger('id_section');
            $table->foreign('id_section')->references('id_section')->on('sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_areas');
    }
};
