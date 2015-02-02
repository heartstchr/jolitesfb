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


<div class="col-md-12 listWrapper">

     <h4 class="lead"> Search Results for {{$query}} </h4>



@if($users->count() != 0)

    @foreach($users as $user1)
        <div class="col-xs-2 col-sm-2" style="margin-top: 5px">
            <div class="well">
                <a class="margin-none" href="{{URL::Route('profile',['profile_id'=>$user1->id])}}">
                    @if($user->profilePicture)
                    <img class="img-responsive" src="{{Croppa::url($user1->profilePicture->link, 100, 100, 'resize')}}">
                    @else
                    <img class="img-responsive" src="{{ asset('assets/image/avatar.jpg')}}" width="100px" height="100px">
                    @endif
                </a>
                <h4 class="media-heading" style="text-align: center">
                    <a href="{{URL::Route('profile',['profile_id'=>$user1->id])}}" class="text-inverse">
                        {{ucwords($user1->first_name)}}
                    </a>
                </h4>
            </div>
        </div>
    @endforeach

@endif

</div>


@stop