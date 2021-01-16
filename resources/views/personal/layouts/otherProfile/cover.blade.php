<div class="row">
    <div class="col-12 grid-margin">
        <div class="profile-header">
            <div class="cover">
                <div class="gray-shade"></div>
                <figure>
                    <img src="https://bootdey.com/img/Content/bg1.jpg" class="img-fluid" alt="profile cover">
                </figure>
                <div class="cover-body d-flex justify-content-between align-items-center">
                    <div>
                        <img class="profile-pic" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="profile">
                        <span class="profile-name">{!! $user->name.' '.$user->surname !!}</span>
                    </div>
                    <div class="d-none d-md-block">
                        @if(Auth::user()->friendRequests()->where('receiver_id',$user->id)->where('status','pending')->orWhere('status','approved')->count())
                            <button class="addFriend btn btn-primary cancel"
                                    onclick="sendRequest('cancel',{{Auth::user()->id}},{{$user->id}})">
                                </svg> Cancel
                            </button>
                        @elseif(Auth::user()->friendRequests()->where('receiver_id',$user->id)->where('status','pending')->orWhere('status','rejected')->count() || Auth::user()->receivedRequests()->where('id',$user->id)->count())
                        @else
                            <button class="addFriend btn btn-primary" onclick="sendRequest('pending',{{Auth::user()->id}},{{$user->id}})">
                                </svg> Add Friend +
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header-links">
                <ul class="links d-flex align-items-center mt-3 mt-md-0">
                    <li class="header-link-item d-flex align-items-center active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-columns mr-1 icon-md">
                            <path
                                d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path>
                        </svg>
                        <a class="pt-1px d-none d-md-block" href="#">Timeline</a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-user mr-1 icon-md">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <a class="pt-1px d-none d-md-block" href="#">About</a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users mr-1 icon-md">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <a class="pt-1px d-none d-md-block" href="#">Friends <span
                                class="text-muted tx-12">{!! count(\App\User::getFriends($user->id)) !!}</span></a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-image mr-1 icon-md">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <a class="pt-1px d-none d-md-block" href="#">Photos</a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-video mr-1 icon-md">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                        <a class="pt-1px d-none d-md-block" href="#">Videos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function sendRequest(status, sender_id, receiver_id) {
        $.post('{{ route('friendRequest') }}', {
            status: status,
            sender_id: sender_id,
            receiver_id: receiver_id,
            _token: '{{ csrf_token() }}'
        }, function (response) {
            if (response.status == 'ok') {
                window.location.reload()
            }
        });
    }
</script>