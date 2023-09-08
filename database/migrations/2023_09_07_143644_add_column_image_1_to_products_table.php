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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_1', 2000)->nullable();
            $table->string('image_mime_1')->nullable();
            $table->integer('image_size_1')->nullable();
            $table->string('image_2', 2000)->nullable();
            $table->string('image_mime_2')->nullable();
            $table->integer('image_size_2')->nullable();
            $table->string('image_3', 2000)->nullable();
            $table->string('image_mime_3')->nullable();
            $table->integer('image_size_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_1');
            $table->dropColumn('image_2');
            $table->dropColumn('image_3');
            $table->dropColumn('image_mime_1');
            $table->dropColumn('image_mime_2');
            $table->dropColumn('image_mime_3');
            $table->dropColumn('image_size_2');
            $table->dropColumn('image_size_3');
        });
    }
};
