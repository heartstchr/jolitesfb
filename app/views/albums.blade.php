@extends('layouts.dash.master')

@section('styles')
@parent

@stop


@section('header_script')
@parent

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
                <h3 class="margin-none">{{ucwords($user1->first_name)}} {{ucwords($user1->last_name)}}</h3>
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
            <h5 class="innerAll margin-none border-bottom bg-gray">Albums</h5>
            <div class="widget-body padding-none" id="albumList">
                <div class="row">
                    @foreach($albums as $album)
                    <div class="col-md-3" style="margin-top: 5px;margin-bottom: 5px">
                        <a href="{{URL::Route('album',['album_id'=>$album->id,'profile_id'=>$user1->id])}}" class="thumbnail">
                            <div class=" holderjs-fluid" id="" style="color: rgb(170, 170, 170); width: 100%; height: 180px; line-height: 180px; background: url(@if($album->first_pic['link']) {{ asset('')}}{{$album->first_pic['link']}} @else {{ asset('assets/images/pattern2.png')}} @endif);"></div>
                            <h5 class="media-heading" style="text-align: center">
                                    {{ucwords($album->label)}}
                            </h5>
                        </a>
                    </div>
                    @endforeach
                </div>
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

<script>

</script>

@stop