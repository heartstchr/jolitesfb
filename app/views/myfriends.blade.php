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
            @if($user->coverPicture)
            <img src="{{ asset('')}}{{$user->coverPicture->link}}" class="img-responsive cover_pic">
            @else
            <img src="{{ asset('assets/images/photodune-2755655-party-time-s.jpg')}}" class="img-responsive cover_pic">
            @endif

        </div>
        <ul class="list-unstyled">
            <li><a href="{{URL::Route('profile',array('profile_id' => $user->id))}}"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a></li>
            <li><a href="{{URL::Route('about',['profile_id' => $user->id])}}"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
            <li><a href="{{URL::Route('photos',['profile_id' => $user->id])}}"><i class="icon-photo-camera"></i> <span>Photos</span></a></li>
            <li class="active"><a href=""><i class="icon-group"></i> <span>Friends</span></a></li>
        </ul>
    </div>
    <div class="widget cover image">
        <div class="widget-body padding-none margin-none">
            <div class="photo">
                @if($user->profilePicture)
                <a href="{{asset('/')}}/{{$user->profilePicture->link}}" class="thumb" style="border-radius:50%;" data-gallery>
{{--                    <img src="{{asset('/')}}/{{$photo->link}}" alt="photo" />--}}
                    <img src="{{ asset('')}}{{$user->profilePicture->link}}" class="img-circle timeline-profile-picture" style="border:0px;">
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
    <div class="work col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">Friend List</h5>
            <div class="widget-body padding-none" id="friendList">
                <div class="row">
                    @if($friends)
                    @foreach($friends as $friend)
                    <div class="col-xs-2 col-sm-2" style="margin-top: 5px">
                        <div class="well">
                            <a class="margin-none" href="{{URL::Route('profile',['profile_id'=>$friend->id])}}">
                                @if($friend->profilePicture)
                                <img class="img-responsive" src="{{ asset('')}}{{$friend->profilePicture->link}}" width="100px" height="100px">
                                @else
                                <img class="img-responsive" src="{{ asset('assets/image/avatar.jpg')}}" width="100px" height="100px">
                                @endif
                            </a>
                            <h4 class="media-heading" style="text-align: center">
                                <a href="{{URL::Route('profile',['profile_id'=>$friend->id])}}" class="text-inverse">
                                    {{ucwords($friend->first_name)}} {{ucwords($friend->last_name)}}
                                </a>
                            </h4>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="" style="margin-top: 5px; text-align: center;">
                            <p> You don't have any friends </p>
                    </div>
                @endif
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

@stop