@extends('layouts.dash.master')

@section('styles')
@parent

@stop


@section('header_script')
@parent
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
@stop

@section('head')



@stop

@section('content')
<div class="timeline-cover">
    <div class="cover image ">
        <div class="top">
            @if($user->coverPicture)
            <img src="{{ asset('')}}{{$user->coverPicture->link}}" class="img-responsive cover_pic">
            @else
            <img src="{{ asset('assets/images/photodune-2755655-party-time-s.jpg')}}" class="img-responsive cover_pic">
            @endif

        </div>
        <ul class="list-unstyled">
            <li class="active"><a href="{{URL::Route('profile',array('profile_id' => $user->id))}}"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a></li>
            <li><a href="{{URL::Route('about',['profile_id' => $user->id])}}"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
            <li><a href="{{URL::Route('photos',['profile_id' => $user->id])}}"><i class="icon-photo-camera"></i> <span>Photos</span></a></li>
            <li><a href="{{URL::Route('friends',['id' => $user->id])}}"><i class="icon-group"></i> <span>Friends</span></a></li>
        </ul>
    </div>
    <div class="widget cover image">
        <div class="widget-body padding-none margin-none">
            <div class="photo">
                @if($user->profilePicture)
                <img src="{{Croppa::url($user->profilePicture->link, 100, 100, 'resize')}}" class="img-circle timeline-profile-picture">
                @else
                <img src="{{ asset('assets/image/avatar.jpg')}}" class="img-circle timeline-profile-picture">
                @endif
            </div>
            <div class="innerAll border-right pull-left">
                <h3 class="margin-none">{{ucwords($user->first_name)}} {{ucwords($user->last_name)}}</h3>
            </div>
            <div class="innerAll pull-left">
<!--                <p class="lead margin-none "> <i class="fa fa-quote-left text-muted fa-fw"></i> What a fun Partyyy</p>-->
                <button class="btn btn-primary cover_pics">Change Cover Picture</button>
                <form method="POST" action="{{URL::Route('uploadCoverPicture')}}" id="cover_pics">
                    <input type="file" id="fileInput" name="fileInput" style="display: none" />
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div>
    <div class="col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">Edit Profile</h5>
            <div class="widget-body padding-none">

                <button class="btn btn-primary" id="change_profile_picture">Change Profile Picture</button>
                <form method="POST" action="{{URL::Route('uploadProfilePicture')}}" id="profile_pic">
                    <input type="file" id="fileInput1" name="fileInput" style="display: none" />
                </form>
                <br>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <strong>Current City</strong>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6">
                                <input class="form-control" id="current_city" placeholder="Enter your address" onFocus="geolocate()" type="text" value="{{$current_city}}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <strong>Hometown</strong>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6">
                                <input class="form-control" id="hometown" placeholder="Enter your address" onFocus="geolocate()" type="text" value="{{$hometown}}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <center><button class="btn btn-primary" id="update_location">Update Location</button></center>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        @if(Session::has('password_error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Current Pasword is wrong
                        </div>
                        @endif
                        @if(Session::has('password_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Great!</strong> Password Changed
                        </div>
                        @endif
                        <form method="post" action="{{URL::Route('updatePassword')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>Current Password</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <input class="form-control" name="current_password" placeholder="Enter your current password" type="password">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>New Password</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <input class="form-control" name="new_password" placeholder="Enter your new password" type="password">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <center><button type="submit" class="btn btn-primary" id="update_password">Update Password</button></center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        @if(Session::has('profile_error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Oops!</strong> Something went wrong
                        </div>
                        @endif
                        @if(Session::has('profile_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Great!</strong> Profile updated
                        </div>
                        @endif
                        <form method="post" action="{{URL::Route('updateProfile')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>First Name</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <input class="form-control" name="first_name" placeholder="Enter your first name" value="{{ucwords($user->first_name)}}" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>Last Name</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <input class="form-control" name="last_name" placeholder="Enter your last name" value="{{ucwords($user->last_name)}}" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>Gender</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <div class="col-xs-6">
                                        <div class="radio">
                                            <label class="radio-custom">
                                                <input type="radio" name="gender" value="2" <?php if($user->gender==2)echo "checked"; ?>>
                                                <i class="fa fa-circle-o checked"></i><h4> Female</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="radio">
                                            <label class="radio-custom">
                                                <input type="radio" name="gender" value="1" <?php if($user->gender==1)echo "checked"; ?>>
                                                <i class="fa fa-circle-o checked"></i><h4> Male</h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <strong>Interested In</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6">
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                            <label class="checkbox-custom">
                                                <input type="checkbox" name="interested_in[]" value="2" <?php if($user->interested_in==2 || $user->interested_in==3)echo "checked"; ?>>
                                                <i class="fa fa-square-o checked"></i><h4> Female</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                            <label class="checkbox-custom">
                                                <input type="checkbox" name="interested_in[]" value="1" <?php if($user->interested_in==1 || $user->interested_in==3)echo "checked"; ?>>
                                                <i class="fa fa-square-o checked"></i><h4> Male</h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <center><button type="submit" class="btn btn-primary">Update profile</button></center>
                                </div>
                            </div>
                        </form>


                        <a href="{{URL::Route('deleteUser')}}"> Delete your profile </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop




@section('footer_script')
@parent
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
    $('#upload').on('click',function(e){
        $('#file').trigger('click');
        e.preventDefault();
    });
    $("button.cover_pics").on('click',function(){
        $("#fileInput").click();
    });
    $("#cover_pics").on('submit',(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{URL::Route('uploadCoverPicture')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                var path = "{{ asset('/uploads/') }}/"+data;
                $('img.cover_pic').attr('src',path);
                $('img#profile-pic').unbind( "click" );
            },
            error: function(){
                console.log("fail");
            }
        });
    }));
    jQuery("input#fileInput").change(function () {
        $('#cover_pics').submit();
    });
</script>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    var placeSearch, autocomplete, hometown,place,place1;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    var componentForm1 = {
        street_number1: 'short_name',
        route1: 'long_name',
        locality1: 'long_name',
        administrative_area_level_11: 'short_name',
        country1: 'long_name',
        postal_code1: 'short_name'
    };

    function initialize() {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('current_city')),
            { types: ['geocode'] });

        hometown = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('hometown')),
            { types: ['geocode'] });


        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });

        google.maps.event.addListener(hometown, 'place_changed', function() {
            fillInAddress1();
        });
    }

    // [START region_fillform]
    function fillInAddress1() {

        place1 = hometown.getPlace();

        for (var component in componentForm1) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place1.address_components.length; i++) {
            var addressType1 = place1.address_components[i].types[0]+1;
            if (componentForm1[addressType1]) {
                document.getElementById(addressType1).value = place1.address_components[i][componentForm1[addressType1]];
            }
        }
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        place = autocomplete.getPlace();


        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }

    }
    // [END region_fillform]

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,geolocation));
                hometown.setBounds(new google.maps.LatLngBounds(geolocation,geolocation));
            });
        }
    }
    // [END region_geolocation]

    $( document ).ready(function() {
        initialize();
    });

    $('#change_profile_picture').on('click',function(){
        $("#fileInput1").click();
    });
    $("#profile_pic").on('submit',(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{URL::Route('uploadProfilePicture')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                var path = "{{ asset('/uploads/') }}/"+data;
                $('.timeline-profile-picture').attr('src',path);
                window.location.reload();
            },
            error: function(){
                console.log("fail");
            }
        });
    }));

    jQuery("input#fileInput1").change(function () {
        $('#profile_pic').submit();
    });
    $('#update_location').on('click',function(){
        var current_city = $('#current_city').val();
        var hometown = $('#hometown').val();
        $.ajax({
            url: "{{URL::Route('updateLocation')}}",
            type: "post",
            data: "current_city="+current_city+"&hometown="+hometown,
            success: function(data)
            {
                window.location.reload();
            },
            error: function(data)
            {
                console.log("fail");
            }
        });
    });

</script>

@stop