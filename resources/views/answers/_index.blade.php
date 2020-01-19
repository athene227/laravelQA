@if('$answersCount'>0)
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount. " ". str_plural('Answer', $answersCount)}}</h2>
                </div>

                <hr>
                @include('layouts._message')
                @foreach ($answers as $answer)

                <div class="media">
                    @include('shared._vote',[
                    'model'=>$answer
                    ])
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                @can('update-answer', $answer)


                                <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                    class="btn btn-sm btn-outline-info">Edit</a>
                                @endcan
                                @can('delete-answer', $answer)
                                <form class="form-delete ml-2" method="POST"
                                    action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')"> Delete </button>

                                </form>
                                @endcan
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="float-right">
                                    @include('shared._author',
                                    [
                                    'model'=>$answer,
                                    'label'=>'answered'
                                    ])

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif