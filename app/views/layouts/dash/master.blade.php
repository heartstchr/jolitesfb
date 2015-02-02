<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if !IE]><!-->
<html class="paceCounter paceSocial footer-sticky">
<!-- <![endif]-->

<head>
    <title>{{{$website_title}}}</title>
    <!-- Meta -->
    @include('layouts.dash.meta')
    <!-- Styles -->
    @include('layouts.dash.styles')
    <!-- Header Scripts -->
    @include('layouts.dash.header_script')
</head>

<body class=" loginWrapper">
<div class="container-fluid">
    <div class="row bg-primary top-nav" style="position: relative">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="logo-icon col-xs-1">
                <a href="{{{URL::Route('root')}}}">
                    <img src="{{{asset('uploads/logo/logo-icon.png')}}}">
                </a>
            </div>
            <div class="col-xs-10 col-sm-8 col-md-6 input-group pull-left row-fix" style="">
                <form action="{{URL::Route('search')}}">
                    <input type="text" class="form-control search" placeholder="Search for people..." name="q">
                </form>
            </div>


<div class="col-xs-4 col-sm-3 col-md-2 row-fix">
    <div class="col-xs-6">
        <a class="btn btn-image" href="{{URL::Route('profile',array('profile_id' => $user->id))}}" style="white-space: nowrap;
                                                                                                                                    overflow: hidden;
                                                                                                                                    text-overflow: ellipsis;
                                                                                                                                    width: 70px;" title="{{ucwords($user->first_name)}}">
            @if($user->profilePicture)

            <img src="{{Croppa::url($user->profilePicture->link, 25, 25, 'resize')}}" height="25px">
            @else
            <img src="{{ asset('assets/image/avatar.jpg')}}" height="25px">
            @endif
            <span class="text" style="height: 25px;border-right: 1px solid;">{{ucwords($user->first_name)}}</span>
        </a>
    </div>
    <div class="col-xs-6" style="">
        <a class="btn btn-image" href="{{URL::Route('home')}}">
            <span class="home">Home</span>
        </a>
    </div>
</div>
<div class="col-xs-8 col-md-3 row-fix">
          <a class="btn btn-image" href="{{URL::Route('messages')}}">
                      <span class="home">Messages</span>
           </a>
           <a class="btn btn-image" href="{{URL::Route('logout')}}">
                           <span class="home">Logout</span>
                </a>
      </div>
            @yield('head')

        </div>
    </div>
    <div class="content col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" style="margin-top: 10px">
        @yield('content')
    </div>
    <div class="row footer">
        <!-- Blueimp Gallery -->
                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev no-ajaxify">‹</a>
                            <a class="next no-ajaxify">›</a>
                            <a class="close no-ajaxify">×</a>
                            <a class="play-pause no-ajaxify"></a>
                            <ol class="indicator"></ol>
                        </div>
                        <!-- // Blueimp Gallery END -->
    </div>
</div>
@include('layouts.dash.footer_script')
</body>

</html>





