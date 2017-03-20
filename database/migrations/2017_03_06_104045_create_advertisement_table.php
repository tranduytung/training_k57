<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::ADVERTISEMENT, function (Blueprint $table) {
            $table->increments('id');
            $table->text('logo')->nullable();
            $table->text('company_name')->nullable();
            $table->text('product_name')->nullable();
            $table->text('content')->nullable();
            $table->text('image')->nullable();
            $table->string('image_size')->nullable();
            $table->text('url')->nullable();
            $table->integer('monthly_budget')->nullable();
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
        Schema::dropIfExists(DBTable::ADVERTISEMENT);
    }
}
