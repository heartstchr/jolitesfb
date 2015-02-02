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

                <h4 class="lead"> Messages </h4>



            <ul class="list-unstyled">

            @foreach($conversations as $conversation)
                <a href="{{URL::Route('viewConversation',array('id'=>$conversation->id))}}">
                    <li class="border-bottom  bg-white">
                        <div class="media innerAll">
                            <div class="media-object pull-left hidden-phone">
                                    @if($messegers[$conversation->id]->profilePicture)
                                    <img src="{{ asset('')}}{{$messegers[$conversation->id]->profilePicture->link}}" class="img-circle" width="45px">
                                    @else
                                    <img src="{{ asset('assets/images/avatar.jpg')}}" class="img-circle" width="45px">
                                    @endif
                            </div>
                            <div class="media-body">
                                <div><span class="strong">{{ucfirst($messegers[$conversation->id]->first_name)}} {{ucfirst($messegers[$conversation->id]->last_name)}}</span> <!-- <small class="text-italic pull-right label label-default">2 days</small> --> </div>
                                <div>{{$conversation->last_message->message}}</div>
                            </div>
                        </div>
                    </li>
                </a>
            @endforeach

            </ul>




</div>


@stop