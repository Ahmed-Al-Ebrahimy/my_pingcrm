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
            $table->date('birth_date');
            $table->tinyInteger('gender');
            $table->tinyInteger('marital')->nullable();
            $table->tinyInteger('smoking')->nullable();

            $table->date('date_of_diagnosis')->nullable();
            $table->date('date_of_insulin')->nullable();

            $table->tinyInteger('mobile')->nullable();
            $table->tinyInteger('parity')->nullable();

            $table->tinyInteger('gdm')->nullable();
            $table->tinyInteger('neuropathy')->nullable();
            $table->tinyInteger('retinopathy')->nullable();
            $table->tinyInteger('f_history')->nullable();
            $table->tinyInteger('fh_of_dm')->nullable();
            $table->tinyInteger('race')->nullable();
            $table->tinyInteger('alcoholic')->nullable();

            $table->integer('father_ht')->nullable();
            $table->integer('mother_ht')->nullable();
            $table->integer('mph')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('bmi')->nullable();
            $table->integer('systolic_bp')->nullable();
            $table->integer('diastolic_bp')->nullable();

            $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('educationlevel_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('occupation_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('type_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('destination_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('clinic_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');

            $table->boolean('queue')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
