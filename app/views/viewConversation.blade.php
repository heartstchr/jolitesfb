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

                <h4 class="lead"> {{ucfirst($friend->first_name)}} {{ucfirst($friend->last_name)}} </h4>



            <ul class="list-unstyled">

                @foreach($messages as $message)
                        <li class="border-bottom  bg-white">
                            <div class="media innerAll">
                                <div class="media-object pull-left hidden-phone">
                                @if($message->sender_id==$user->id)
                                        @if($user->profilePicture)
                                        <img src="{{ asset('')}}{{$user->profilePicture->link}}" class="img-circle" width="45px">
                                        @else
                                        <img src="{{ asset('assets/images/avatar.jpg')}}" class="img-circle" width="45px">
                                        @endif
                                </div>
                                <div class="media-body">
                                    <div><span class="strong">{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</span> <!-- <small class="text-italic pull-right label label-default">2 days</small> --> </div>
                                @else
                                         @if($user->profilePicture)
                                         <img src="{{ asset('')}}{{$friend->profilePicture->link}}" class="img-circle" width="45px">
                                         @else
                                         <img src="{{ asset('assets/images/avatar.jpg')}}" class="img-circle" width="45px">
                                         @endif
                                 </div>
                                 <div class="media-body">
                                     <div><span class="strong">{{ucfirst($friend->first_name)}} {{ucfirst($friend->last_name)}}</span> <!-- <small class="text-italic pull-right label label-default">2 days</small> --> </div>
                                @endif
                                    <div>{{$message->message}}</div>
                                </div>
                            </div>
                        </li>
                @endforeach

            </ul>

            <form action="{{URL::Route('sendMessage')}}" method="POST">
                <input type="text" name="receiver" value="{{$friend->id}}" style="display:none;"/>
                <textarea class="form-control" name="message" placeholder="Write your message here..."></textarea>
                <input type="submit" class="btn btn-primary float-right" value="Send Message">
            </form>




</div>


@stop