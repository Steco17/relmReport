<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('package_name');
            $table->string('package_color');
            $table->string('main_image');
            $table->text('destination_user');
            $table->text('destination_number');            
            $table->string('package_code');
            $table->text('content');
            $table->text('description');
            $table->string('destination_country');
            $table->string('destination_region');
            $table->string('destination_city');
            $table->float('package_price');
            $table->float('package_weight');
            $table->float('package_length');
            $table->float('package_height');
            $table->string('package_video');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->enum('is_featured',['No','Yes']);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('packages');
    }
}
