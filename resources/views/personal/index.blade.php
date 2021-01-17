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
            @include('personal.layouts.middle',['friends' => $friends,'posts'=>$posts])
            <!-- middle wrapper end -->
            </div>
        </div>
    </div>

    </body>
@endsection
