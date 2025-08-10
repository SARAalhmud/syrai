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
    Schema::create('rated_people', function (Blueprint $table) {
        $table->id();

        // المُقيِّم (أي مستخدم)
        $table->foreignId('rater_id')->constrained('users')->onDelete('cascade');


      $table->morphs('rated');
        $table->tinyInteger('rating_value')->unsigned(); // من 1 إلى 5
        $table->text('comment')->nullable();

        $table->timestamps();

        // منع التكرار: مستخدم لا يمكنه تقييم نفس الشخص مرتين
        $table->unique(['rater_id', 'rated_id', 'rated_type']);
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rated_people');
    }
};
