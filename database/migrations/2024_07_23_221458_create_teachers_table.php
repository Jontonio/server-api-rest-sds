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
        Schema::create('teachers', function (Blueprint $table) {
            $table->string('id_card', 15)->unique()->primary();
            $table->string('type_id_card',20);
            $table->string('names',50);
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',100);
            $table->string('phone_number',9);
            $table->string('status',1)->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
