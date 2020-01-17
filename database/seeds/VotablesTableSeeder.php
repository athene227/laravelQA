<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Answer;
use App\Question;
class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->delete();

        $users = User::all();
        $numberOfUsers= $users->count();
        $votes = [-1,1];

        foreach(Question::all()as $question){
            for($index=0; $index<rand(1,$numberOfUsers);$index++){
                $user =$users[$index];
                $user->voteQuestion($question, $votes[rand(0,1)]);
            }
        }
        $users = User::all();
        $numberOfUsers= $users->count();
        $votes = [-1,1];

        foreach(Answer::all()as $answer){
            for($index=0; $index<rand(1,$numberOfUsers);$index++){
                $user =$users[$index];
                $user->voteAnswer($answer, $votes[rand(0,1)]);
            }
        }
    }
}
