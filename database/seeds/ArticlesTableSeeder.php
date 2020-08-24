<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = DB::table('users')->first();

        foreach (range(1, 3) as $num) {
            DB::table('articles')->insert([
                'title' => "サンプル記事{$num}",
                'category_id' => 1,
                'text' => "テストテストテスト{$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'sample.png',
                'user_id' => $user->id,
            ]);
        }
    }
}
