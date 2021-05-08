<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ingredients')->insert([
            'name' => 'Thịt gà',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt dê',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt chó',
            'unit' => 'kg',

        ]);
        
        DB::table('ingredients')->insert([
            'name' => 'Thịt lợn',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt trâu',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt bò',
            'unit' => 'kg',
            
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt cừu',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Thịt voi',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Gia vị ',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Mì chính',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Mắm tôm',
            'unit' => 'kg',

        ]);

        DB::table('ingredients')->insert([
            'name' => 'Đường',
            'unit' => 'kg',

        ]);
    }
}
