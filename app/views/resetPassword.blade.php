@extends('layouts.auth.master')

@section('content')
<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 signup_response">
    <div class="col-xs-12 title">
        Set New Password
    </div>
    <div class="col-xs-12 body">
        {{ Form::open(array('class' => 'sign-up', 'method' => 'post', 'route' => 'resetPasswordProcess')) }}
        <div class="col-xs-12" style="display: none">
            <input type="text" class="form-control" name="code" value="{{$code}}" required>
        </div>
        <div class="col-xs-12">
            <input type="password" class="form-control" name="password" placeholder="New Password" required>
        </div>
        <div class="col-xs-12" style="margin-top: 10px">
            <button class="btn btn-primary sign-up" type="submit">Continue</button>
        </div>
        {{Form::close()}}
    </div>
</div>
@stop