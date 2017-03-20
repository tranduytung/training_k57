<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;

class InsertCategoryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        foreach ($this->data() as $key => $value) {
            $data[] = ['id' => $key, 'name' => $value];
        }

        Category::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $keys = array_keys($this->data());
        Category::whereIn('id', $keys)->delete();
    }

    /**
     * @return array
     */
    protected function data()
    {
        return [
            1 => '貧困問題',
            2 => '飢餓問題',
            3 => '健康・福祉',
            4 => '教育',
            5 => '性差別',
            6 => 'トイレ、衛生',
            7 => 'エネルギー',
            8 => '雇用・労働',
            9 => 'インフラ整備',
            10 => '不平等・格差',
            11 => 'まちづくり',
            12 => '資源問題',
            13 => '気候変動・排出ガス',
            14 => '海洋資源保護',
            15 => '森林保護',
            16 => '平和・法制度',
            17 => '途上国への投資',
        ];
    }
}
