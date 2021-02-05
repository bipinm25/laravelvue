<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_masters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('parent_id')->unsigned();     
            $table->integer('teacher_id')->unsigned();     
            $table->integer('class_id')->unsigned();     
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender',['Male','Female','Other']);
            $table->date('dob');
            $table->date('doj');
            $table->text('address_1');   
            $table->text('address_2');
            $table->integer('state_id')->unsigned();       
            $table->integer('district_id')->unsigned();       
            $table->integer('city_id')->unsigned();      
            $table->string('phone');
            $table->string('email');                  
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
        Schema::dropIfExists('student_masters');
    }
}
