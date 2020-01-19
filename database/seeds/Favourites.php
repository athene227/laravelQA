<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
class Favourites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('favourite')->delete();
       $users = User::pluck('id')->all();
       $numberofUsers= count($users);
       foreach (Question::all() as $question){
           for($i=0; $i<rand(0,$numberofUsers); $i++){
               $user= $users[$i];
               $question->favourite()->attach($user);
           }
       }
    }
}
