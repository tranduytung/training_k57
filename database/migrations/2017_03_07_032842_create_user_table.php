<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::USER, function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('email', 200)->collation('ascii_general_ci')->unique('email');
            $table->string('password', 255);
            $table->integer('area_id')->unsigned()->nullable();
            $table->text('avatar')->nullable();
            $table->date('birdthday')->nullable();
            $table->string('access_token', 255)->nullable();
            $table->tinyInteger('gender')->default(0)->comment('0=not choose, 1=女性, 2＝男性');
            $table->string('device_id', 255);
            $table->tinyInteger('device_type')->comment('1=iOS, 2=Android');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('area_id')->references('id')->on(DBTable::AREA);
        });

        Schema::create(DBTable::USER_SOCIAL_ACTION, function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('social_action_id')->unsigned()->index();

            $table->foreign('user_id')->references('id')->on(DBTable::USER);
            $table->foreign('social_action_id')->references('id')->on(DBTable::SOCIAL_ACTION);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::USER_SOCIAL_ACTION);
        Schema::dropIfExists(DBTable::USER);
    }
}
