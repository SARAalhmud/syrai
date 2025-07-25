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
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'experts_id')->nullable();
            $table->foreign('experts_id')->references('id')->on('experts')->onDelete('cascade');
            $table->unsignedBigInteger(column: 'beginners_id')->nullable();
            $table->foreign('beginners_id')->references('id')->on('beginners')->onDelete('cascade');
  $table->unsignedBigInteger(column: 'students_id')->nullable();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
  $table->unsignedBigInteger(column: 'companies_id')->nullable();
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
$table->string('section');
$table->string('title');
$table->text('content');
$table->string('keywords')->nullable();
    $table->unsignedBigInteger('views')->default(0);         // عدد المشاهدات
    $table->unsignedInteger('replies_count')->default(0);
    $table->unsignedBigInteger('user_id')->nullable();
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('forums');
    }
};
