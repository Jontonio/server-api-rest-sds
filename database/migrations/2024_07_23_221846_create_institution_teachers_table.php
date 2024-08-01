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
        Schema::create('institution_teachers', function (Blueprint $table) {
            $table->increments('id_ie_teacher');
            $table->string('status',1)->default(true);
            $table->string('id_card',15);
            $table->foreign('id_card')->references('id_card')->on('teachers');
            $table->string('modular_code',8);
            $table->foreign('modular_code')->references('modular_code')->on('institutions');
            $table->unsignedInteger('id_college')->nullable();
            $table->foreign('id_college')->references('id_college')->on('colleges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institution_teachers');
    }
};
