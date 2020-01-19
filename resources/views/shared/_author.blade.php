<div class="media">
    <a href="{{$model->user->url}}" class="pr-2">
        <img src="{{$model->user->avatar}}">
    </a>
    <div class="media-body mt-1">
        <a href="{{$model->user->url}}">{{$model->user->name}}</a>
    </div>
</div>
<span class="text-muted  mt-2">  {{$label.' '.$model->created_at}} </span>