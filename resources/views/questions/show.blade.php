@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                    <h1> {{$question->title}} </h1>
                    <div class="ml-auto">
                    <a href={{route('questions.index')}} class="btn btn-outline-primary" > Back to All Questions</a>
                    </div>
                    </div>
               </div>

                <div class="card-body">
                {!! $question->body_html !!}
                <div class="float-right">
                    <div class="media">
                        <a href="{{$question->user->url}}" class="pr-2">
                          <img src="{{$question->user->avatar}}">  
                        </a>
                        <div class="media-body mt-1">
                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                        </div>
                        </div>
                    <span class="text-muted  mt-2"> Answered {{$question->created_at}} </span>
                    
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h2>{{$question->answers_count. " ". str_plural('Answer', $question->answers_count)}}</h2>
                    </div>
                    <hr>
                    @foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="float-right">
                                    <div class="media">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                          <img src="{{$answer->user->avatar}}">  
                                        </a>
                                        <div class="media-body mt-1">
                                        <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                        </div>
                                    <span class="text-muted  mt-2"> Answered {{$answer->created_at}} </span>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection