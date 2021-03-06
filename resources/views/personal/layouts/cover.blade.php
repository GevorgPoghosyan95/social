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
                        <span class="profile-name">{!! Auth::user()->name.' '.Auth::user()->surname !!}</span>
                    </div>
                    <button class="btn btn-primary btn-icon-text btn-edit-profile" id="newPost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit btn-icon-prepend">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg> Add New Post
                    </button>
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
                        <a class="pt-1px d-none d-md-block" style="cursor: pointer" onclick="showPosts()">My Posts</a>
                    </li>
                    {{--                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">--}}
                    {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-1 icon-md">--}}
                    {{--                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>--}}
                    {{--                            <circle cx="12" cy="7" r="4"></circle>--}}
                    {{--                        </svg>--}}
                    {{--                        <a class="pt-1px d-none d-md-block" href="#">About</a>--}}
                    {{--                    </li>--}}
                    <li class="friendsClass header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users mr-1 icon-md">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <a class="pt-1px d-none d-md-block" onclick="showFriendList()"
                           style="cursor: pointer">Friends {!! count(\App\User::getFriends(Auth::id())) !!}
                            <span class="text-muted tx-12"></span></a>
                    </li>
                    {{--                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">--}}
                    {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image mr-1 icon-md">--}}
                    {{--                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>--}}
                    {{--                            <circle cx="8.5" cy="8.5" r="1.5"></circle>--}}
                    {{--                            <polyline points="21 15 16 10 5 21"></polyline>--}}
                    {{--                        </svg>--}}
                    {{--                        <a class="pt-1px d-none d-md-block" href="#">Photos</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">--}}
                    {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video mr-1 icon-md">--}}
                    {{--                            <polygon points="23 7 16 12 23 17 23 7"></polygon>--}}
                    {{--                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>--}}
                    {{--                        </svg>--}}
                    {{--                        <a class="pt-1px d-none d-md-block" href="#">Videos</a>--}}
                    {{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
@include('personal.postTemplate')
