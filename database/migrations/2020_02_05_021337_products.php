<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products',function(Blueprint $table){
            $table->increments('id');            
            $table->string('name');             
            $table->integer('category_id');             
            $table->string('slug');             
            $table->integer('price');            
            $table->integer('weight');             
            $table->text('description');             
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
        //
    }
}
