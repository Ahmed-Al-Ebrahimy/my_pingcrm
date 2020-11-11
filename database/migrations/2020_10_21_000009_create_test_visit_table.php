<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('test_visit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('visit_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('value');
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
        Schema::dropIfExists('test_visit');
    }
}
