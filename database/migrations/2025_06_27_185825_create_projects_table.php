<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'experts_id')->nullable();
            $table->foreign('experts_id')->references('id')->on('experts')->onDelete('cascade');
            $table->unsignedBigInteger(column: 'beginners_id')->nullable();
            $table->foreign('beginners_id')->references('id')->on('beginners')->onDelete('cascade');
  $table->unsignedBigInteger(column: 'students_id')->nullable();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
  $table->unsignedBigInteger(column: 'companies_id')->nullable();
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('projectname')->nullable();
            $table->text('projectdescription')->nullable();
            $table->string('projectlink')->nullable();
            $table->json('projectskills')->nullable();
            $table->json('projectimages')->nullable();

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
        Schema::dropIfExists('projects');
    }
};
