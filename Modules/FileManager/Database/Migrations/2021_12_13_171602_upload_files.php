<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UploadFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('alternative_text', 255);
            $table->string('caption', 255);
            $table->integer('width');
            $table->integer('height');
            $table->string('hash', 255);
            $table->string('extension', 10);
            $table->string('mime', 150);
            $table->decimal('size');
            $table->decimal('url');
            $table->longText('meta_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_files');
    }
}
