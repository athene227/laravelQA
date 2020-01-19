@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

<div class="d-flex flex-column vote-controls">
    <a title="This {{$name}} is useful" class="vote-up {{Auth::guest() ? 'off': ''}}"
        onclick="event.preventDefault(); document.getElementById('up-vote-{{$name}}-{{$model->id}}').submit();">
        <i class="fas fa-caret-up  fa-2x"></i>
    </a>
    <form hidden id="up-vote-{{$name}}-{{ $model->id }}" action="/{{$firstURISegment}}/{{$model->id}}/vote"
        method="POST">
        @csrf
        <input type="hidden" name='vote' value="1">
    </form>
    <span class="votes-count">{{$model->votes_count}}</span>
    <a title="This {{$name}} is not useful" class="vote-down  {{Auth::guest() ? 'off': ''}}"
        onclick="event.preventDefault(); document.getElementById('down-vote-{{$name}}-{{$model->id}}').submit();">

        <i class="fas fa-caret-down fa-2x"></i>
    </a>
    <form hidden id="down-vote-{{$name}}-{{ $model->id }}" action="/{{$firstURISegment}}/{{$model->id}}/vote"
        method="POST">
        @csrf
        <input type="hidden" name='vote' value="-1">
    </form>
    @can('accept-{{$name}}',$model)
    <a title="Mark this {{$name}} as best {{$name}}" class="{{$model->status}}"
        onclick="event.preventDefault(); document.getElementById('accept-{{$name}}-{{$model->id}}').submit();">
        <i class="fas fa-check  fa-2x"></i>
    </a>
    <form hidden id="accept-{{$name}}-{{ $model->id }}"
        action="{{ route('answers.accept', [$model->id]) }}" method="POST">
        @csrf
    </form>
    @else
    @if($model->is_best)
    <a title="The question owner marked this as best answer" class="{{$model->status}}">
        <i class="fas fa-check  fa-2x"></i>
    </a>
    @endif
    @endcan
</div>