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
        Schema::create('teacher_coors', function (Blueprint $table) {
            $table->increments('id_teacher_coor');
            $table->string('status',1)->default(true);
            $table->unsignedInteger('id_ie_teacher');
            $table->foreign('id_ie_teacher')->references('id_ie_teacher')->on('institution_teachers');
            $table->unsignedInteger('id_college');
            $table->foreign('id_college')->references('id_college')->on('colleges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_coors');
    }
};
