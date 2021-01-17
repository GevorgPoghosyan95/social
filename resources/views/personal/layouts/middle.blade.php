<div class="col-md-8 col-xl-6 middle-wrapper">
    <div class="row" id="posts">
        @if(isset($posts))
            @foreach($posts as $post)
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="img-xs rounded-circle"
                                         src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                    <div class="ml-2">
                                        <p>{!! \App\User::find($post->user_id)->name.' '.\App\User::find($post->user_id)->surname !!}</p>
                                        <p class="tx-11 text-muted">{!! $post->created_at !!}</p>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-more-horizontal icon-lg pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete',array('class' => 'btn btn-danger btn-sm','style'=>'margin-left:35px')) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>{!! $post->title !!}</h3>
                            <p class="mb-3 tx-14">
                                {!! $post->content !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row" id="friends">
        @foreach(json_decode($friends) as $friend)
            <a href="/showProfile/{!! $friend->id !!}" style="padding-top: 10px">
                <div class="friends d-flex align-items-center">
                    <img class="img-xs rounded-circle"
                         src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                    <div class="ml-2">
                        <p>{!! $friend->name.' '.$friend->surname !!}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

