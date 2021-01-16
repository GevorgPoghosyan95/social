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
                        @if(userHasFriendRequest($user))
                            <button class="addFriend btn btn-primary cancel"
                                    onclick="sendRequest('cancel',{{Auth::user()->id}},{{$user->id}})">
                                </svg> Cancel
                            </button>
                        @elseif(usersAreFriends($user))
                            <button class="addFriend btn btn-primary cancel"
                                    onclick="sendRequest('cancel',{{Auth::user()->id}},{{$user->id}})">
                                </svg> UnFriend
                            </button>
                        @elseif(userHasRejectedRequest($user))
                        @else
                            <button class="addFriend btn btn-primary"
                                    onclick="sendRequest('pending',{{Auth::user()->id}},{{$user->id}})">
                                </svg> Add Friend +
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header-links">
                <ul class="links d-flex align-items-center mt-3 mt-md-0">
                    <li class="postClass header-link-item d-flex align-items-center active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-columns mr-1 icon-md">
                            <path
                                d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path>
                        </svg>
                        <a class="pt-1px d-none d-md-block" style="cursor: pointer" onclick="showPosts()">Timeline</a>
                    </li>
                    <li class="friendsClass header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users mr-1 icon-md">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <a class="pt-1px d-none d-md-block" onclick="showFriendList({!! $user->id !!})"
                           style="cursor: pointer">Friends {!! count(\App\User::getFriends($user->id)) !!}
                            <span class="text-muted tx-12"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
