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
        Schema::create('jops', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger(column: 'experts_id')->nullable();
            $table->foreign('experts_id')->references('id')->on('experts')->onDelete('cascade');
          $table->unsignedBigInteger(column: 'companies_id')->nullable();
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
          $table->string('jobTitle');
          $table->string('companyName');
          $table->string('jobType');
             $table->string('jobLocation');
               $table->string('experienceLevel');
                 $table->string('salaryRange');
                   $table->string('jobCategory');
                     $table->text('jobDescription');
                       $table->string('jobRequirements');
                         $table->string('contactEmail');
                                 $table->boolean('is_closed')->default(false);
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
        Schema::dropIfExists('jops');
    }
};
