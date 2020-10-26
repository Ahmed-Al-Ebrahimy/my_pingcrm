<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('patients', function (Blueprint $table) {

            $table->id();
            $table->string('name', 35)->unique();
            $table->string('diagnosis')->nullable();

            $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');


            $table->date('birth_date');
            $table->tinyInteger('gender');
            $table->tinyInteger('marital_status')->nullable();
            $table->tinyInteger('smoking')->nullable();


            $table->softDeletes();

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
        Schema::dropIfExists('patients');
    }
}
