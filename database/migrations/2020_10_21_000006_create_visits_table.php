<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade')->onUpdate('cascade');



            $table->decimal('mph', 3, 1)->nullable();
            $table->decimal('height', 3, 1)->nullable();
            $table->decimal('weight', 3, 1)->nullable();
            $table->decimal('bmi', 3, 1)->nullable();
            $table->decimal('systolic_bp', 3, 1)->nullable();
            $table->decimal('diastolic_bp', 3, 1)->nullable();

            $table->string('notes')->nullable();

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
        Schema::dropIfExists('visits');
    }
}
