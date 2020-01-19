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
                        @include('shared._vote',[
                        'model'=>$question
                        ])
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                @include('shared._author',
                                [
                                'model'=>$question,
                                'label'=>'Questioned'
                                ])
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