<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndDescriptionToImagesTable extends Migration
{
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
}
