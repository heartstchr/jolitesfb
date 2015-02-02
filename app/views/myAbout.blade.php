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
            <li class="active"><a href="{{URL::Route('about',['profile_id' => $user->id])}}"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
            <li><a href="{{URL::Route('photos',['profile_id' => $user->id])}}"><i class="icon-photo-camera"></i> <span>Photos</span></a></li>
            <li><a href="{{URL::Route('friends',['id' => $user->id])}}"><i class="icon-group"></i> <span>Friends</span></a></li>
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
            <h5 class="innerAll margin-none border-bottom bg-gray">Work<button class="newwork btn btn-primary float-right" href="#newwork" data-toggle="modal"><i class="fa fa-plus"></i> Add New</button></h5>
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
            <h5 class="innerAll margin-none border-bottom bg-gray">High School <button class="newhighschool btn btn-primary float-right" href="#newhighschool" data-toggle="modal"><i class="fa fa-plus"></i> Add New</button></h5>
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
            <h5 class="innerAll margin-none border-bottom bg-gray">College <button class="newcollege btn btn-primary float-right" href="#newcollege" data-toggle="modal"><i class="fa fa-plus"></i> Add New</button></h5>
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



<div class="modal fade" id="newwork">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Add a workplace</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerAll">
                    <div class="innerLR">
                        <form class="form-horizontal" method="post" role="form" id="newworkform">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company" placeholder="Where have you worked ?" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Position</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="position" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="description" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">From</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker1" name="from" type="text" >
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">To</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker2" name="to" type="text" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
            <!-- // Modal body END -->

        </div>
    </div>

</div>

<div class="modal fade" id="newhighschool">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Add a high school</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerAll">
                    <div class="innerLR">
                        <form class="form-horizontal" method="post" role="form" id="newhighschoolform">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">School</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="school" placeholder="Which school did you attend ?" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="description" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Graduated?</label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label class="checkbox-custom">
                                            <input type="checkbox" name="graduated" >
                                            <i class="fa fa-fw fa-square-o checked"></i> Checked checkbox
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">From</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker1" name="from" type="text" >
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">To</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker2" name="to" type="text" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
            <!-- // Modal body END -->

        </div>
    </div>

</div>


<div class="modal fade" id="newcollege">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Add a college</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerAll">
                    <div class="innerLR">
                        <form class="form-horizontal" method="post" role="form" id="newcollegeform">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">School</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="school" placeholder="Which school did you attend ?" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="description" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Graduated?</label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label class="checkbox-custom">
                                            <input type="checkbox" name="graduated" >
                                            <i class="fa fa-fw fa-square-o checked"></i> Checked checkbox
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">From</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker1" name="from" type="text" >
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-2 control-label">To</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker2" name="to" type="text" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
            <!-- // Modal body END -->

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

    $('#newworkform').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{URL::Route('addWork')}}",
            type: "POST",
            data: $('#newworkform').serializeArray(),
            success: function(data)
            {
                $('#newwork').modal('hide');
                var time;
                if(data.from)
                {
                    time = "From: "+data.from;
                    if(data.to)
                    {
                        time = time+" - To: "+data.to;
                    }
                    else
                    {
                        time = time+" - Present";
                    }
                }
                var str = "<div class=\"media border-bottom innerAll margin-none\"><div class=\"media-body\"><h5 class=\"margin-none\">"+data.company+"</h5><h6 class=\"margin-none\">"+data.position+", "+data.city+"</h6><small>Description: "+data.description+"</small><br><small>"+time+"</small></div></div>";
                $("#workList").append(str);
            },
            error: function(){
                console.log('fail');
            }
        });

    });

    $('#newhighschoolform').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{URL::Route('addHighSchool')}}",
            type: "POST",
            data: $('#newhighschoolform').serializeArray(),
            success: function(data)
            {
                $('#newhighschool').modal('hide');
                var graduated;
                if(data.graduated)
                {
                    graduated = "Yes";
                }
                else
                {
                    graduated = "No";
                }
                var time;
                if(data.from)
                {
                    time = "From: "+data.from;
                    if(data.to)
                    {
                        time = time+" - To: "+data.to;
                    }
                    else
                    {
                        time = time+" - Present";
                    }
                }
                var str = "<div class=\"media border-bottom innerAll margin-none\"><div class=\"media-body\"><h5 class=\"margin-none\">"+data.school+"</h5><h6 class=\"margin-none\">"+data.city+"</h6><small>Description: "+data.description+"</small><br><small>Graduated: "+graduated+"</small><br><small>"+time+"</small></div></div>";
                $(".highschoollist").append(str);
            },
            error: function(){
                console.log('fail');
            }
        });

    });

    $('#newcollegeform').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{URL::Route('addCollege')}}",
            type: "POST",
            data: $('#newcollegeform').serializeArray(),
            success: function(data)
            {
                $('#newcollege').modal('hide');
                var graduated;
                if(data.graduated)
                {
                    graduated = "Yes";
                }
                else
                {
                    graduated = "No";
                }
                var time;
                if(data.from)
                {
                    time = "From: "+data.from;
                    if(data.to)
                    {
                        time = time+" - To: "+data.to;
                    }
                    else
                    {
                        time = time+" - Present";
                    }
                }
                var str = "<div class=\"media border-bottom innerAll margin-none\"><div class=\"media-body\"><h5 class=\"margin-none\">"+data.school+"</h5><h6 class=\"margin-none\">"+data.city+"</h6><small>Description: "+data.description+"</small><br><small>Graduated: "+graduated+"</small><br><small>"+time+"</small></div></div>";
                $(".collegelist").append(str);
            },
            error: function(){
                console.log('fail');
            }
        });

    });
</script>

@stop