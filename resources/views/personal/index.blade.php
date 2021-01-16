@extends('personal.layouts.app')
@section('body')
    <body>
    @include('personal.layouts.navbar')
    <div class="container">
        <div class="profile-page tx-13">
            @include('personal.layouts.cover')
            <div class="row profile-body">
                <!-- left wrapper start -->
            @include('personal.layouts.left')
            <!-- left wrapper end -->
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-6 middle-wrapper">
                    @include('personal.layouts.middle')
                </div>
                <!-- middle wrapper end -->
                <!-- right wrapper start -->
            {{--            @include('personal.layouts.right')--}}
            <!-- right wrapper end -->
            </div>
        </div>
    </div>

    </body>
@endsection
