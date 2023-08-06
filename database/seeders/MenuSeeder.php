<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coffee;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coffee::create([
            "coffee"=>"Latte",
            "price"=>"20000",
            "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit.
             Quidem impedit iusto animi asperiores soluta laborum nesciunt? Aut magnam dicta molestias.",
            "img"=> "coffee/latte.jpg"
        ]);
        Coffee::create([
            "coffee"=>"Expresso",
            "price"=>"25000",
            "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit.
             Quidem impedit iusto animi asperiores soluta laborum nesciunt? Aut magnam dicta molestias.",
            "img"=> "coffee/expresso.jpg"
        ]);
        Coffee::create([
            "coffee"=>"Thai Tea",
            "price"=>"25000",
            "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit.
             Quidem impedit iusto animi asperiores soluta laborum nesciunt? Aut magnam dicta molestias.",
            "img"=> "coffee/thaitea.jpg"
        ]);
        Coffee::create([
            "coffee"=>"Green Tea",
            "price"=>"25000",
            "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit.
             Quidem impedit iusto animi asperiores soluta laborum nesciunt? Aut magnam dicta molestias.",
            "img"=> "coffee/greenTea.jpg"
        ]);
        Coffee::create([
            "coffee"=>"Kopi Susu",
            "price"=>"25000",
            "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit.
             Quidem impedit iusto animi asperiores soluta laborum nesciunt? Aut magnam dicta molestias.",
            "img"=> "coffee/kopisusu.jpg"
        ]);
    }
}
