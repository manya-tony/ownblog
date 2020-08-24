<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = DB::table('users')->first();

        $names = ['エッセイ', '暮らし', 'エンターテインメント'];

        foreach ($names as $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
