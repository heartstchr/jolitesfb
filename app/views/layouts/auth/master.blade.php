
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie paceCounter paceSocial footer-sticky"> <![endif]-->
<!--[if !IE]><!--><html class="paceCounter paceSocial footer-sticky"><!-- <![endif]-->
<head>
    <title>{{{$website_title}}}</title>
    <!-- Meta -->
    @include('layouts.auth.meta')
    <!-- Styles -->
    @include('layouts.auth.styles')
    <!-- Header Scripts -->
    @include('layouts.auth.header_script')
</head>
<body class=" loginWrapper">
    <div class="container-fluid">
        <div class="row header bg-primary">
            <div class="col-xs-12 col-sm-4 col-md-6">
                <div class="logo">
                    <a href="{{{URL::Route('root')}}}" >
                        <img src="{{{asset('uploads/logo/logo.png')}}}">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6">
                <div class="row">
                    <form role="form" method="post" action="{{URL::Route('login')}}">
                        <div class="col-xs-5 col-sm-4">
                            <div class="form-group no-margin-bottom">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="true">
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-4">
                            <div class="form-group no-margin-bottom">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="true">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2">
                            <button type="submit" class="btn btn-primary btn-block login">Log In</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-sm-4">
                        <div class="checkbox">
                            <label class="checkbox-custom link">
                                <i class="fa fa-fw fa-square-o checked"></i>
                                <input type="checkbox" checked="checked"> Keep me logged in
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-4">
                        <a href="{{URL::Route('forgotPassword')}}" class="link">Forgot Password ?</a>
                    </div>
                    <div class="col-xs-2 col-sm-2">

                    </div>
                </div>

            </div>
        </div>
        <div class="row content">
            @yield('content')
        </div>
        <div class="row footer">
        <!--footer content goes here-->
        </div>
    </div>
@include('layouts.auth.footer_script')
</body>
</html>







