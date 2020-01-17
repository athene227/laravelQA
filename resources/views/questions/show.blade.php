@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1> {{$question->title}} </h1>
                            <div class="ml-auto">
                                <a href={{route('questions.index')}} class="btn btn-outline-primary"> Back to All
                                    Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                        <a title="This question is useful"
                         class="vote-up {{Auth::guest() ? 'off': ''}}"
                         onclick="event.preventDefault(); document.getElementById('up-vote-question-{{$question->id}}').submit();"
                         >
                         <form hidden id="up-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote" method="POST">
                            @csrf
                            <input type="hidden" name='vote' value="1">
                            </form>
                                 

                            <i class="fas fa-caret-up  fa-2x"></i>
                                </a>
                            <span class="votes-count">{{$question->votes_count}}</span>
                                <a title="This question is not useful" class="vote-down  {{Auth::guest() ? 'off': ''}}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{$question->id}}').submit();"
                         >
                         <form hidden id="down-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote" method="POST">
                            @csrf
                            <input type="hidden" name='vote' value="-1">
                            </form>
                                <i class="fas fa-caret-down fa-2x"></i>
                                </a>
                                <a title="Click to mark as favourite question" class="favourite favourited">
                                    <i class="fas fa-star  fa-2x"></i>
                                </a>
                                <span class="favourites-count ">123</span>
                        </div>
                        <div class="media-body">
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
        </div>
    </div>
@include('.answers._index',[
    'answers'=>$question->answers,
    'answersCount'=>$question->answers_count,
    ])
   @include('answers._create')
</div>
@endsection