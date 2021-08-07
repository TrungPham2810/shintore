<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Ốp Lưng Iphone', 'url_key' => 'op-lung-iphone', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Kính Cường Lực', 'url_key' => 'kinh-cuong-luc', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Quạt Mini', 'url_key' => 'quat-mini', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Chân máy ảnh', 'url_key' => 'chan-may-anh', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Tai Nghe', 'url_key' => 'tai-nghe', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Cáp Sạc', 'url_key' => 'cap-sac', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Giắc chuyển đổi', 'url_key' => 'jack-lightning', 'parent_id' => 0, 'status' => 1],
        ]);
    }
}
