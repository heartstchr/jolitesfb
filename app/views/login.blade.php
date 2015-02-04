@extends('layouts.auth.master')

@section('content')
@if(Session::has('flash_success'))
<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 signup_response">
    <div class="col-xs-12 title">
        Activate you account
    </div>
    <div class="col-xs-12 body">
        An activation link has been mailed to you, Please click on the link to activate you account and start using this awesome social networking site.
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
@else
<div class="hidden-xs hidden-sm col-md-6 sign-up-left">
    <h2 class="bold color">Connect with other jolites around you.</h2>
    <p class="tip"><span class="color"><i class="fa fa-image"></i> See photos and updates</span> from friends in News Feed.</p>
    <p class="tip"><span class="color"><i class="fa fa-share-square-o"></i> Share what's new</span> in your life on your timeline</p>
    <p class="tip"><span class="color"><i class="fa fa-cog"></i> Configure your Profile</span> to get connected with similar people</p>
</div>
<div class="col-xs-12 col-md-6 sign-up-right">
    <h1 class="color">Sign Up!</h1>
    <h4 class="color">Exclusively for jolites.</h4>
    {{ Form::open(array('class' => 'sign-up', 'method' => 'post', 'route' => 'register')) }}
    <div class="col-md-6 col-xs-12 no-padding first_name">
        <input type="text" class="form-control" name="first_name" placeholder="First name" required>
    </div>
    <div class="col-md-6 col-xs-12 no-padding last_name">
        <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
    </div>
    <div class="col-xs-12 no-padding">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="col-xs-12 no-padding">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <div class="col-xs-12 no-padding">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <div class="col-xs-12 no-padding">
        <h4>Birthday</h4>
        <select class="selectpicker col-xs-3 col-sm-2 no-padding" name="month" data-style="btn-custom">
            <option value="-1">Month</option>
            <option value="1">Jan</option>
            <option value="2">Feb</option>
            <option value="3">Mar</option>
            <option value="4">Apr</option>
            <option value="5">May</option>
            <option value="6">Jun</option>
            <option value="7">Jul</option>
            <option value="8">Aug</option>
            <option value="9">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dev</option>
        </select>
        <select class="selectpicker col-xs-3 col-sm-2 no-padding" name="day" data-style="btn-custom">
            <option value="-1">Day</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>

        </select>
        {{ Form::selectYear('year', 1914, 2015, 2014,['class' => 'selectpicker col-xs-3 col-sm-2 no-padding','name'=>"year",'data-style'=>"btn-custom"]) }}
        <div class="col-xs-3 col-sm-6 no-padding">
            <!--Why do I need to provide my birthday?-->

        </div>
    </div>
    <div class="col-xs-12 no-padding">
        <div class="col-xs-3 col-sm-2">
            <div class="radio">
                <label class="radio-custom">
                    <input type="radio" name="gender" value="female" checked="checked">
                    <i class="fa fa-circle-o checked"></i><h4> Female</h4>
                </label>
            </div>
        </div>
        <div class="col-xs-3 col-sm-2">
            <div class="radio">
                <label class="radio-custom">
                    <input type="radio" name="gender" value="male" checked="checked">
                    <i class="fa fa-circle-o checked"></i><h4> Male</h4>
                </label>
            </div>
        </div>

    </div>
    <button class="btn btn-success sign-up" type="submit">Sign Up</button>
    {{Form::close()}}
</div>
@endif
@stop