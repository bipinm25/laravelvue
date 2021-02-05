<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('first_name');
            $table->string('last_name');           
            $table->enum('gender',['Male','Female','Other']);
            $table->date('dob');
            $table->date('doj');      
            $table->text('education');      
            $table->text('address_1');   
            $table->text('address_2');   
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
        Schema::dropIfExists('teachers');
    }
}
