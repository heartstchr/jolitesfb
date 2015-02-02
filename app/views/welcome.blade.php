@extends('layouts.dash.master')

@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('assets/plugins/forms_editors_wysihtml5/css/bootstrap-wysihtml5-0.0.2.css') }}">
@stop


@section('header_script')
@parent
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
@stop



@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId={{$_ENV['FB_APP_ID']}}&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Form Wizard / Arrow navigation & Progress bar -->
<div id="rootwizard" class="wizard welcome">

    <!-- Wizard heading -->
    <div class="wizard-head">
        <ul>
            <li><a href="#tab1" data-toggle="tab">Invite Friends</a></li>
            <li><a href="#tab3" data-toggle="tab">Basic Info</a></li>
            <li><a href="#tab2" data-toggle="tab">Upload Profile Picture</a></li>

        </ul>
    </div>
    <!-- // Wizard heading END -->

    <div class="widget">

        <!-- Wizard Progress bar -->
        <div class="widget-head progress progress-primary" id="bar" style="margin-left:-1px">
            <div class="progress-bar">Step <strong class="step-current">1</strong> of <strong class="steps-total">3</strong> - <strong class="steps-percent">100%</strong></div>
        </div>
        <!-- // Wizard Progress bar END -->

        <div class="widget-body">
            <div class="tab-content">

                <!-- Step 1 -->
                <div class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-sm-8  col-sm-offset-2 col-md-6  col-md-offset-3 ">
                            <strong>Invite Your Friends!</strong>
                            <p class="muted">Invite your friends to join this awesome social network, and start <b>Phasebook'ing!!</b></p>
                            <div>
                                <table class="invite">
                                    <tr>
                                        <td valign="middle">
                                            <a class="btn btn-primary" onClick="javascript:window.open('http://www.facebook.com/share.php?u={{URL::to('/')}}','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false;" >
                                                <i class="fa fa-facebook"></i> Share
                                            </a>
                                        </td>
                                        <td style="padding-top: 25px">
                                            <div class="fb-send" data-href="{{URL::to('/')}}" data-width="300" data-height="50" data-colorscheme="light"></div>
                                        </td>
                                        <td valign="middle">
                                            <a href="https://twitter.com/share" data-url="{{URL::to('/')}}" data-text="Check this awesome social networking site  || " class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="large" data-count="none">Tweet</a>
                                        </td>
                                        <td valign="middle">
                                            <div class="g-plus" data-action="share" data-annotation="none" data-height="24" data-href="{{URL::to('/')}}"></div>
                                        </td>
                                    </tr>
                                </table>





                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Step 1 END -->

                <!-- Step 2 -->
                <div class="tab-pane" id="tab2">
                    <div class="row">
                        <div class="col-sm-8  col-sm-offset-2 col-md-6  col-md-offset-3 " style="text-align: center">
                            <strong>Enhance your profile with your photo!</strong>
                            <div>
                                <img src="{{ asset('assets/images/avatar.jpg') }}" id="profile-pic" style="width:30%">
                                <form method="POST" action="{{URL::Route('uploadProfilePicture')}}" id="profile_pic">
                                    <input type="file" id="fileInput" name="fileInput" style="display: none" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Step 2 END -->

                <!-- Step 3 -->
                <div class="tab-pane" id="tab3">
                    <div class="row">
                        <div class="col-sm-8  col-sm-offset-2 col-md-6  col-md-offset-3 " style="text-align: center">
                            <br>
                            <strong>Fill in some data to make a fantabulous profile!</strong>
                            <br><br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <strong>Current City</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" id="current_city" placeholder="Enter your address" onFocus="geolocate()" type="text"></input>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <strong>Hometown</strong>
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" id="hometown" placeholder="Enter your address" onFocus="geolocate()" type="text"></input>
                                </div>
                            </div>

                            <table id="address" style="display:none ">
                                <tr>
                                    <td class="label">Street address</td>
                                    <td class="slimField">
                                        <input class="field" id="street_number" disabled="true"></input>
                                    </td>
                                    <td class="wideField" colspan="2">
                                        <input class="field" id="route" disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">City</td>
                                    <td class="wideField" colspan="3">
                                        <input class="field" id="locality" disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">State</td>
                                    <td class="slimField">
                                        <input class="field" id="administrative_area_level_1" disabled="true"></input>
                                    </td>
                                    <td class="label">Zip code</td>
                                    <td class="wideField">
                                        <input class="field" id="postal_code"disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Country</td>
                                    <td class="wideField" colspan="3"
                                        ><input class="field" id="country" disabled="true"></input>
                                    </td>
                                </tr>
                            </table>


                            <table id="address" style="display:none ">
                                <tr>
                                    <td class="label">Street address</td>
                                    <td class="slimField">
                                        <input class="field1" id="street_number1" disabled="true"></input>
                                    </td>
                                    <td class="wideField" colspan="2">
                                        <input class="field1" id="route1" disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">City</td>
                                    <td class="wideField" colspan="3">
                                        <input class="field1" id="locality1" disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">State</td>
                                    <td class="slimField">
                                        <input class="field1" id="administrative_area_level_11" disabled="true"></input>
                                    </td>
                                    <td class="label">Zip code</td>
                                    <td class="wideField">
                                        <input class="field1" id="postal_code1"disabled="true"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Country</td>
                                    <td class="wideField" colspan="3"
                                        ><input class="field1" id="country1" disabled="true"></input>
                                    </td>
                                </tr>
                            </table>



                        </div>
                    </div>
                </div>
                <!-- // Step 3 END -->

            </div>

            <!-- Wizard pagination controls -->
            <div style="text-align: center"><ul class="pagination margin-bottom-none">
                <li class="primary previous"><a href="#" class="no-ajaxify">Previous</a></li>
                <li class="next primary"><a href="#" class="no-ajaxify">Next</a></li>
                <li class="next finish primary" style="display:none;"><a href="#" class="no-ajaxify">Finish</a></li>
            </ul></div>
            <!-- // Wizard pagination controls END -->

        </div>
    </div>
</div>
<!-- // Form Wizard / Arrow navigation & Progress bar END -->


@stop




@section('footer_script')
@parent
<script src="{{ asset('assets/components/forms_wizards/form-wizards.init.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/plugins/forms_wizards/jquery.bootstrap.wizard.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/components/forms_editors_wysihtml5/wysihtml5.init.js?v=v2.0.0-rc8') }}"></script>
<script src="{{ asset('assets/plugins/forms_editors_wysihtml5/js/bootstrap-wysihtml5-0.0.2.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/plugins/forms_editors_wysihtml5/js/wysihtml5-0.3.0_rc2.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="{{ asset('assets/js/jquery.form.js') }}"></script>
<script>
    !function(d,s,id)
    {var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
    {js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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

    $('img#profile-pic').on('click',function(){
        $("#fileInput").click();
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
                $('img#profile-pic').attr('src',path);
                $('img#profile-pic').unbind( "click" );
            },
            error: function(){
                console.log("fail");
            }
        });
    }));

    jQuery("input#fileInput").change(function () {
        $('#profile_pic').submit();
    });
</script>

@stop