<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except'=> ['index','show']]);
        
            }
            
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        
        $request->validate([
            'body'=> 'required'
        ]);
        $question->answers()->create(['body'=>$request->body, 'user_id'=>\Auth::id()]); 
             return back()->with('success', "Your answer has been submitted successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        if(\Gate::allows('update-answer', $answer)){
            return view('answers.edit', compact('question','answer'));
            }
            else{
                abort(403, 'Access denied');
            }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Answer $answer)
    {
        if(\Gate::allows('update-answer', $answer)){
            $answer->update($request->validate([
                    'body'=>'required',
            ]));
            return redirect()->route('questions.show',$question->slug)->with('success','Your question has been updated');
            }
            else{
                abort(403, 'Access denied');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        if(\Gate::allows('delete-answer', $answer)){
            if($question->best_answer_id!= $answer->id){
                $answer->delete();
                return redirect()->route('questions.show', $question->slug)->with('success', "Your question has been successfully deleted.");
            }
           return redirect()->route('questions.show',$question->slug)->with('error', 'Your answer can not be deleted');
            }
        else{
                abort(403, 'Access denied');
            }
    }
}
