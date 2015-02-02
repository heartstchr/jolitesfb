@extends('layouts.dash.master')

@section('styles')
@parent

@stop


@section('header_script')
@parent
<link rel="stylesheet" href="{{asset('assets/plugins/media_blueimp/css/blueimp-gallery.min.css')}}"/>
@stop

@section('head')



@stop

@section('content')
<div class="timeline-cover">
    <div class="cover image ">
        <div class="top">
            @if($user1->coverPicture)
            <img src="{{ asset('')}}{{$user1->coverPicture->link}}" class="img-responsive cover_pic">
            @else
            <img src="{{ asset('assets/images/photodune-2755655-party-time-s.jpg')}}" class="img-responsive cover_pic">
            @endif

        </div>
        <ul class="list-unstyled">
            <li><a href="{{URL::Route('profile',array('profile_id' => $user1->id))}}"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a></li>
            <li><a href="{{URL::Route('about',['profile_id' => $user1->id])}}"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
            <li class="active"><a href=""><i class="icon-photo-camera"></i> <span>Photos</span></a></li>
            <li><a href="{{URL::Route('friends',['profile_id'=>$user1->id])}}"><i class="icon-group"></i> <span>Friends</span></a></li>
        </ul>
    </div>
    <div class="widget cover image">
        <div class="widget-body padding-none margin-none">
            <div class="photo">
                @if($user1->profilePicture)
                <a href="{{asset('/')}}/{{$user1->profilePicture->link}}" class="thumb" style="border-radius:50%;" data-gallery>
{{--                    <img src="{{asset('/')}}/{{$photo->link}}" alt="photo" />--}}
                    <img src="{{ asset('')}}{{$user1->profilePicture->link}}" class="img-circle timeline-profile-picture" style="border:0px;">
                </a>
                @else
                <img src="{{ asset('assets/image/avatar.jpg')}}" class="img-circle timeline-profile-picture">
                @endif
            </div>
            <div class="innerAll border-right pull-left">
                <h3 class="margin-none">{{ucwords($user->first_name)}} {{ucwords($user->last_name)}}</h3>
            </div>
            <div class="innerAll pull-left">
                <!--                <p class="lead margin-none "> <i class="fa fa-quote-left text-muted fa-fw"></i> What a fun Partyyy</p>-->
<!--                <button class="btn btn-primary cover_pics">Change Cover Picture</button>-->
<!--                <form method="POST" action="{{URL::Route('uploadCoverPicture')}}" id="cover_pics">-->
<!--                    <input type="file" id="fileInput" name="fileInput" style="display: none" />-->
<!--                </form>-->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div>
    <div class="work col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">Albums <button style="padding:2px 10px;line-height: 0px" class="btn btn-primary float-right" href="#newalbum" data-toggle="modal"><i class="fa fa-plus"></i> Add New</button></h5>
            <div class="widget-body padding-none" id="albumList">
                <div data-toggle="gridalicious" data-gridalicious-width="280" data-gridalicious-gutter="0">
                    <div class="innerAll inner-2x loading text-center text-medium">
                        <i class="fa fa-fw fa-spinner fa-spin"></i> Loading
                    </div>
                    <div class="loaded hide2">
                        @foreach($photos as $photo)
                        <div class="widget widget-heading-simple widget-body-white widget-pinterest">
                            <div class="widget-body padding-none">
                                <a href="{{asset('/')}}/{{$photo->link}}" class="thumb" data-gallery>
                                    <img src="{{asset('/')}}/{{$photo->link}}" alt="photo" />
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>





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
    </div>
</div>


@stop




@section('footer_script')
@parent
<script src="{{ asset('assets/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v2.0.1-rc1&sv=v0.0.1.2')}}"></script>
<script src="http://cdn2.mosaicpro.biz/shared/assets/components/forms_elements_bootstrap-datepicker/bootstrap-datepicker.init.js?v=v2.0.1-rc1&sv=v0.0.1.2"></script>
<script src="{{ asset('assets/plugins/media_holder/holder.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>

<script src="{{ asset('assets/plugins/media_gridalicious/jquery.gridalicious.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/components/media_gridalicious/gridalicious.init.js?v=v2.0.0-rc8') }}"></script>
<script src="{{ asset('assets/plugins/media_blueimp/js/blueimp-gallery.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/plugins/media_blueimp/js/jquery.blueimp-gallery.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>



<script>

</script>

@stop