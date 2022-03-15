<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $categories = [
            ["type" => "historical", "description" => "historical post"],
            ["type" => "gossip", "description" => "gossip post"],
            ["type" => "travel", "description" => "travel post"],
            ["type" => "crime", "description" => "crime post"],
                
        ];

        foreach ($categories as $category) {
            $newCat = new Category();
            $newCat->fill($category);
            $newCat->save();
        }  
    }
}