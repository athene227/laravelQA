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
                    <div class="d-flex flex-column vote-controls">
                        <a title="This answer is useful" class="vote-up">
                            <i class="fas fa-caret-up  fa-2x"></i>
                        </a>
                        <span class="votes-count">1230</span>
                        <a title="This answer is not useful" class="vote-down off">
                            <i class="fas fa-caret-down fa-2x"></i>
                        </a>
                        <a title="Mark this answer as best answer" class="vote-accepted">
                            <i class="fas fa-check  fa-2x"></i>
                        </a>
                        
                </div>
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