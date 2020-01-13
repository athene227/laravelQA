@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                <h4>Edit Your Answer for question: <strong> {{$question->title}}</strong></h4>
                </div>
                <hr>
                @include('layouts._message')
            <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">
                        @csrf 
                        @method('patch')
                        <div class="form-group">
                        <textarea class="form-control {{$errors->has('body')? 'is-invalid':''}}" rows='7' name='body'>{{old('body', $answer->body)}}</textarea>
                        @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{$errors->first('body')}}
                                </div>
                        @endif
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">Update</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection