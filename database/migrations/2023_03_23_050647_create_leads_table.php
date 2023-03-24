<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->string("phone");
            $table->string("gender");
            $table->string("location");
            $table->integer("user_id");
            $table->integer("converted")->default(0); //Will help to determine if a lead has been converted into a customer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
