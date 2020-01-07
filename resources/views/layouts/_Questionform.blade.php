@csrf
<div class="form-group">
<label for="question-title"> Question Title </label>
<input type="text" name="title" value='{{old('title', $question->title)}}' id="question-title" class="form-control {{$errors->has('title') ? 'is-invalid': ''}}">
@if ($errors->has('title'))
<div class="invalid-feedback">
    {{ $errors->first('title') }}
</div>
@endif
</div>
<div class="form-group">
<label for="question-body"> Explain your Question </label>
<textarea type="text" name="body" id="question-body" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid': ''}}">{{old('body',$question->body)}}</textarea>
 @if ($errors->has('body'))
<div class="invalid-feedback">
{{ $errors->first('body') }}
</div>
@endif
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-lg">{{$btnText}}</button>
</div>