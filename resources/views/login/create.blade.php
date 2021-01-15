@extends('login.layouts.app')
<link rel="stylesheet" href="css/createAccount.css">
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="signup-form">
                    <form action="{!! route('create') !!}" method="post">
                        <h2>Register</h2>
                        <p class="hint-text">Create your account. It's free and only takes a minute.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6"><input type="text" class="form-control" name="name" placeholder="Name" required="required"></div>
                                <div class="col-xs-6"><input type="text" class="form-control" name="surname" placeholder="Surname" required="required"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

