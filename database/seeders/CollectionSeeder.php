<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::create([
            'id'=> '1',
            'collection_name'=> 'WORLD CHAMPION JR GP'
        ]);

        Collection::create([
            'id'=> '2',
            'collection_name'=> 'KTM AJO'
        ]);

    }
}
