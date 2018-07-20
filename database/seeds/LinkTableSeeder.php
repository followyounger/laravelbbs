<?php

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $links = factory(Link::class)->times(6)->make();
        // 将数据集合转换为数据，并插入到数据库中
        Link::insert($links->toArray());
    }
}