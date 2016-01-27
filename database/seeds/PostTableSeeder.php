<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        //create post sides
        DB::table('posts')->delete();
        for($i=0;$i<5;$i++){
            \App\Posts::create(['title' => "first post {$i}",'description'=>"this is a {$i} post description","content"=>"this is a {$i} post content"]);
        }
    }
}
