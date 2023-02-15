<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->text('link')->nullable();
            $table->longText('episodes')->nullable();
            $table->string('image')->nullable();
            $table->string('image_link')->nullable();
            $table->text('trailer');
            $table->integer('view_count')->default('0');
            $table->integer('download_count')->default('0');
            $table->string('actors')->nullable();
            $table->string('studio')->nullable();
            $table->string('director')->nullable();
            $table->string('type')->nullable();
            $table->string('role',15)->default('free');
            $table->tinyInteger('new_arrived')->default(0);
            $table->string('released_at',15)->nullable();
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
        Schema::dropIfExists('movies');
    }
};
