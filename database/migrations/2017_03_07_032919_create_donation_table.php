<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::DONATION, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('social_action_id')->unsigned();
            $table->integer('advertisement_id')->unsigned();
            $table->integer('calorie_value')->nullable();
            $table->integer('donation')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on(DBTable::USER);
            $table->foreign('social_action_id')->references('id')->on(DBTable::SOCIAL_ACTION);
            $table->foreign('advertisement_id')->references('id')->on(DBTable::ADVERTISEMENT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::DONATION);
    }
}
