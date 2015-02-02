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
            <li class="active"><a href="{{URL::Route('about',['profile_id' => $user1->id])}}"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
            <li><a href="{{URL::Route('photos',['profile_id' => $user1->id])}}"><i class="icon-photo-camera"></i> <span>Photos</span></a></li>
            <li><a href="{{URL::Route('friends',['id' => $user1->id])}}"><i class="icon-group"></i> <span>Friends</span></a></li>
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

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div>
    <div class="work col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">Work</h5>
            <div class="widget-body padding-none" id="workList">
                @foreach($works as $work)
                @if($work)
                <div class="media border-bottom innerAll margin-none">
                    <div class="media-body">
                        <h5 class="margin-none">{{ucwords($work->company->label)}}</h5>
                        <h6 class="margin-none">
                            @if($work->position->label)
                            {{ucwords($work->position->label)}}
                            @endif
                            {{", "}}
                            @if($work->city->label)
                            {{ucwords($work->city->label)}}
                            @endif
                        </h6>
                        <small>Description: {{$work->desc}}</small><br>
                        <small>
                            @if($work->from)
                            {{"From: ".$work->from}}
                                @if($work->to)
                                {{" - To: ".$work->to}}
                                @else
                                {{" - To: Present"}}
                                @endif
                            @endif
                        </small>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="work col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">High School</h5>
            <div class="widget-body padding-none highschoollist">
                @foreach($highschools as $highschool)
                @if($highschool)
                <div class="media border-bottom innerAll margin-none">
                    <div class="media-body">
                        <h5 class="margin-none">{{ucwords($highschool->school->label)}}</h5>
                        <h6 class="margin-none">
                            @if($highschool->city->label)
                            {{ucwords($highschool->city->label)}}
                            @endif
                        </h6>
                        <small>Description: {{$highschool->desc}}</small><br>
                        <small>Graduated:
                        @if($highschool->graduated)
                            Yes
                        @else
                            No
                        @endif
                        </small><br>
                        <small>
                            @if($highschool->from)
                            {{"From: ".$highschool->from}}
                            @if($work->to)
                            {{" - To: ".$highschool->to}}
                            @else
                            {{" - To: Present"}}
                            @endif
                            @endif
                        </small>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="work col-xs-12">
        <div class="widget">
            <h5 class="innerAll margin-none border-bottom bg-gray">College</h5>
            <div class="widget-body padding-none collegelist">
                @foreach($colleges as $college)
                @if($college)
                <div class="media border-bottom innerAll margin-none">
                    <div class="media-body">
                        <h5 class="margin-none">{{ucwords($college->school->label)}}</h5>
                        <h6 class="margin-none">
                            @if($college->city->label)
                            {{ucwords($college->city->label)}}
                            @endif
                        </h6>
                        <small>Description: {{$college->desc}}</small><br>
                        <small>Graduated:
                            @if($college->graduated)
                            Yes
                            @else
                            No
                            @endif
                        </small><br>
                        <small>
                            @if($college->from)
                            {{"From: ".$college->from}}
                            @if($work->to)
                            {{" - To: ".$college->to}}
                            @else
                            {{" - To: Present"}}
                            @endif
                            @endif
                        </small>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>



</div>




@stop




@section('footer_script')
@parent
<script src="{{ asset('assets/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v2.0.1-rc1&sv=v0.0.1.2')}}"></script>
<script src="http://cdn2.mosaicpro.biz/shared/assets/components/forms_elements_bootstrap-datepicker/bootstrap-datepicker.init.js?v=v2.0.1-rc1&sv=v0.0.1.2"></script>


@stop