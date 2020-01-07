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
        if( $this->answers>0 ){
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

}