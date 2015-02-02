@extends('layouts.dash.master')

@section('styles')
@parent

@stop


@section('header_script')
@parent

@stop

@section('head')
<style>
    .pac-container {
        z-index: 99999!important;
    }
</style>



@stop

@section('content')
<div class="col-md-3">
    <div style="float:left;padding-right: 10px">
        @if($user->profilePicture)
        <img src="{{ asset('')}}{{$user->profilePicture->link}}" width="50px">
        @else
        <img src="{{ asset('assets/image/avatar.jpg')}}" height="50px">
        @endif
    </div>

    <b>{{ucwords($user->first_name)}} {{ucwords($user->last_name)}}</b>
    <br>
    <a href="">Edit Profile</a>
</div>
<div class="col-md-6">

    <div class="widget">

    	<!-- Widget heading -->
    	<div class="widget-head">
    		<h4 class="heading">Buy Ads</h4>
    	</div>
    	<!-- // Widget heading END -->

    	<div class="widget-body innerAll inner-2x">

    		<!-- Table -->
    		<table class="table table-bordered table-primary">

    			<!-- Table heading -->
    			<thead>
    				<tr>
    					<th>Name</th>
    					<th>Features</th>
    					<th>Price</th>
    					<th>Validity(Days)</th>
    					<th>Action</th>
    				</tr>
    			</thead>
    			<!-- // Table heading END -->

    			<!-- Table body -->
    			<tbody>

                    @foreach($adSpaces as $adSpace)
                        <!-- Table row -->
                        <tr>
                            <td>{{ $adSpace->name }}</td>
                            <td>{{ $adSpace->features }}</td>
                            <td>${{ $adSpace->price }}</td>
                            <td>{{ $adSpace->validity }}</td>
                            <td>@if(!$adSpace->ad)<button data-ad-slot="{{ $adSpace->id }}" data-toggle="modal" data-target="#buyAdModal" class="btn btn-primary buy-ad">Buy</button>@elseif($adSpace->ad->paid == 0 && $adSpace->ad->user_id == $user->id) <button class="btn btn-primary">Pay</button> @else Ad Bought @endif</td>
                        </tr>
                        <!-- // Table row END -->
    				@endforeach

    			</tbody>
    			<!-- // Table body END -->

    		</table>
    		<!-- // Table END -->

    	</div>
    </div>

    <div class="widget">

        	<!-- Widget heading -->
        	<div class="widget-head">
        		<h4 class="heading">Your Ads</h4>
        	</div>
        	<!-- // Widget heading END -->

        	<div class="widget-body innerAll inner-2x">

        		<!-- Table -->
        		<table class="table table-bordered table-primary">

        			<!-- Table heading -->
        			<thead>
        				<tr>
        					<th>Name</th>
        					<th>Impressions</th>
        					<th>Clicks</th>
        					<th>Valid Till</th>
        					<th>Action</th>
        				</tr>
        			</thead>
        			<!-- // Table heading END -->

        			<!-- Table body -->
        			<tbody>

                        @foreach($user->ads as $ad)
        				<!-- Table row -->
        				<tr>
        					<td>{{ $ad->pricing->name }}</td>
        					<td>{{ $ad->impressions }}</td>
        					<td>{{ $ad->clicks }}</td>
        					<td>{{ 'date' }}</td>
        					<td>
        					    <button data-toggle="modal" data-target="#editAdModal{{ $ad->id }}" class="btn btn-primary">Edit</button>
        					    <a href="{{ URL::route('deleteAd', ['id' => $ad->id]) }}" class="btn btn-danger">Delete</a>
        					</td>
        				</tr>
        				<!-- // Table row END -->
        				<div class="modal fade" id="editAdModal{{ $ad->id;  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="{{ URL::route('editAd') }}" method="post" enctype="multipart/form-data">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Ad</h4>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="ad_id" value="{{ $ad->id }}" />
                                    <label for="ad_link" class="col-sm-2 control-label">Ad Link</label>
                                    <input type="text" class="form-control" name="ad_link" placeholder="Ad Link" value="{{ json_decode($ad->content, true)['link'] }}"/>
                                    <label for="ad_image" class="col-sm-2 control-label">Ad Image</label>
                                    <input type="file" name="ad_image" placeholder="Ad Image" class="form-control"/>
                                    <label for="start_age" class="col-sm-2 control-label">Start Age</label>
                                    <input type="number" name="start_age" class="form-control col-md-6" placeholder="Start Age" value="{{ json_decode($ad->filters, true)['start_age'] }}"/>
                                    <label for="end_age" class="col-sm-2 control-label">End Age</label>
                                    <input type="number" name="end_age" class="form-control col-md-6" placeholder="End Age" value="{{ json_decode($ad->filters, true)['end_age'] }}"/>
                                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="1" @if(json_decode($ad->filters, true)['gender'] == 1) selected @endif>Male</option>
                                        <option value="2" @if(json_decode($ad->filters, true)['gender'] == 2) selected @endif>Female</option>
                                        <option value="3" @if(json_decode($ad->filters, true)['gender'] == 3) selected @endif>Both</option>
                                    </select>
                                    <label for="place" class="col-sm-2 control-label">Place</label>
                                    <input type="text" id="place" class="form-control" name="place" onFocus="geolocate()" placeholder="Place" value="{{ json_decode($ad->filters, true)['place'] }}"/>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
        				@endforeach

        			</tbody>
        			<!-- // Table body END -->

        		</table>
        		<!-- // Table END -->

        	</div>
        </div>

</div>
<div class="col-md-3">

</div>
<div class="modal fade" id="buyAdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ URL::route('buyAd') }}" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Buy Ad</h4>
          </div>
          <div class="modal-body">
            <input id="buyAdSlot" type="hidden" name="slot_id" />
            <label for="ad_link" class="col-sm-2 control-label">Ad Link</label>
            <input type="text" class="form-control" name="ad_link" placeholder="Ad Link"/>
            <label for="ad_image" class="col-sm-2 control-label">Ad Image</label>
            <input type="file" name="ad_image" placeholder="Ad Image" class="form-control"/>
            <label for="start_age" class="col-sm-2 control-label">Start Age</label>
            <input type="number" name="start_age" class="form-control col-md-6" placeholder="Start Age"/>
            <label for="end_age" class="col-sm-2 control-label">End Age</label>
            <input type="number" name="end_age" class="form-control col-md-6" placeholder="End Age"/>
            <label for="gender" class="col-sm-2 control-label">Gender</label>
            <select class="form-control" name="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Both</option>
            </select>
            <label for="place" class="col-sm-2 control-label">Place</label>
            <input type="text" id="place" class="form-control" name="place" onFocus="geolocate()" placeholder="Place"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Buy</button>
          </div>
      </form>
    </div>
  </div>
</div>
@stop




@section('footer_script')
@parent
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script src="{{ asset('assets/js/jquery.form.js') }}"></script>
<script>

    var placeSearch, autocomplete,place;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initialize() {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('place')),
            { types: ['geocode'] });

        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });
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
            });
        }
    }
    // [END region_geolocation]

    $( document ).ready(function() {
        initialize();
    });


    $('.buy-ad').click(function(){
        $('#buyAdSlot').val($(this).data('ad-slot'));
    });

</script>

@stop