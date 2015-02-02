@extends('layouts.auth.master')

@section('content')
@if(Session::has('flash_success'))
<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 signup_response">
    <div class="col-xs-12 title">
        Reset Password
    </div>
    <div class="col-xs-12 body">
        A link has been mailed to you, Please click on the link to set a new password.
    </div>
</div>
@elseif(Session::has('flash_error'))
<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 signup_response">
    <div class="col-xs-12 title">
        ERROR!!!
    </div>
    <div class="col-xs-12 body">
        {{{Session::get('flash_error')}}}
    </div>
</div>
@endif
<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 signup_response">
    <div class="col-xs-12 title">
        Forgot Password ?
    </div>
    <div class="col-xs-12 body">
        {{ Form::open(array('class' => 'sign-up', 'method' => 'post', 'route' => 'forgotPassword')) }}
        <div class="col-xs-12">
            <input type="text" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="col-xs-12" style="margin-top: 10px">
            <button class="btn btn-primary sign-up" type="submit">Continue</button>
        </div>
        {{Form::close()}}
    </div>
</div>
@stop