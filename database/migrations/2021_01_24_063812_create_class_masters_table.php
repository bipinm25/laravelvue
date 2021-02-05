<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_masters', function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('class_name');
            $table->string('class_division')->nullable();            
            $table->integer('teacher_id')->unsigned();            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_masters');
    }
}
