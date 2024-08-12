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
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id_notice');
            $table->string('notice_title', 300);
            $table->text('notice_text');
            $table->date('date_expiration');
            $table->text('notice_url_img');
            $table->text('notice_adj_file');
            $table->text('notice_autor');
            $table->string('status')->default(true);
            $table->string('modular_code',8);
            $table->foreign('modular_code')->references('modular_code')->on('institutions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
