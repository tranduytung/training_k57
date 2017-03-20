<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::SOCIAL_ACTION, function (Blueprint $table) {
            $table->increments('id');
            $table->text('thumbnail')->nullable();
            $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->text('url')->nullable();
            $table->text('activity_content')->nullable();
            $table->integer('donation_rate')->nullable();
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
        Schema::dropIfExists(DBTable::SOCIAL_ACTION);
    }
}
