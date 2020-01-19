<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['title', 'body'];
    public function user(){
        return $this->belongsTo(User::Class);
    }   
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug']= str_slug($value);
    }
    public function getUrlAttribute(){
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->format('d/m/y');
    }

    public function getStatusAttribute(){
        if( $this->answers_count>0 ){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    public function favourites()
    {
        return $this->belongsToMany(User::class, 'favourites')->withTimestamps(); //, 'question_id', 'user_id');
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
    public function votes(){
        return $this->morphToMany(User::class, 'Votable');
    }
    public function upVotes(){ 
        return $this->votes()->wherePivot('vote',1);
    }
    
    public function downVotes(){
        return $this->votes()->wherePivot('vote',-1);
    }
}
