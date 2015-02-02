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
<div class="col-md-3">
    <div style="float:left;padding-right: 10px">
        @if($user->profilePicture)
        <img src="{{Croppa::url($user->profilePicture->link, 50, 50, 'resize')}}" class="img-circle timeline-profile-picture">
        @else
        <img src="{{ asset('assets/image/avatar.jpg')}}" height="50px">
        @endif
    </div>

    <b>{{ucwords($user->first_name)}} {{ucwords($user->last_name)}}</b>
    <br>
    <a href="{{URL::Route('editProfile')}}">Edit Profile</a>
    <br>
    <br>
    <ul class="nav nav-stacked">
        <li>
            <a href="{{URL::Route('friends',Auth::getUser()->id)}}"> Friends </a>
            <a href="{{URL::Route('photos',Auth::getUser()->id)}}"> Photos </a>
            <a href="{{URL::Route('messages')}}"> Messages </a>
            <a href="{{URL::Route('adsPage')}}"> Ads </a>
        </li>
    </ul>

    <div class="widget">
        <h5 class="innerAll margin-none border-bottom bg-gray">Notifications({{$notifications->count()}})</h5>
        <div class="widget-body padding-none">
            @foreach($notifications as $notification)
            <?php
                $content = json_decode($notification->content, true);
                if(isset($content['image_path']))
                    $image = $content['image_path'];
                else
                    $image = 'assets/image/avatar.jpg';
            ?>
            <div class="media border-bottom innerAll margin-none">
                <img src="{{Croppa::url($image, 50, 50, 'resize')}}" class="pull-left media-object"/>
                <div class="media-body">
                    <h5 class="margin-none"><a href="{{$content['link']}}" class="text-inverse">{{$content['message']}}</a></h5>
                    <small>{{date('d M Y H:i:s')}} </small>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>


<div class="col-md-6">

    <div class="widget widget-heading-simple widget-body-white">
        <!-- // Widget heading END -->

        <div class="widget-body">
            <label>Update Status</label>
                <form method="post" id="statusForm" action="{{URL::Route('addStatus')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="content" required></textarea>
                    </div>
                    <button class="btn btn-primary" id="upload">Add Photos/Video</button>
                    <button type="submit" class="btn btn-primary">POST</button>
                    <input type="file" name="file[]" id="file" style="display: none" multiple>
                </form>
        </div>

    </div>


    <!-- posts -->
    @foreach($posts as $post)
    <div class="widget widget-heading-simple widget-body-white">
        <div class="widget-body">
            <div class="row">
                <div class="col-xs-2">
                <a href="{{URL::route('profile',$post->user->id)}}">
                    @if($post->user->profilePicture)
                    <img src="{{Croppa::url($post->user->profilePicture->link, 50, 50, 'resize')}}" width="50px" class="post_profile_picture">
                    @else
                    <img src="{{ asset('assets/image/avatar.jpg')}}" height="50px">
                    @endif
                </a>
                </div>
                <div class="col-xs-10">
                    <a href="{{URL::route('profile',$post->user->id)}}"><b>{{ucwords($post->user->first_name)}} {{ucwords($post->user->last_name)}}</b></a>
                    <br/>
                    <small>{{ Carbon::parse($post->created_at)->diffForHumans(Carbon::now()) }}</small>
                </div>
                <br>
            </div>
            <div>
                @if($post->type == 1)
                    {{{ $post->originalPost->content }}}
                    
                    @if($post->attachments->count())
                        @foreach($post->attachments as $attachment)
                            @if($attachment->media->type == 1)
                                <img src="{{{ asset($attachment->media->link) }}}" style="width:100%;" alt=""/>
                            @elseif($attachment->media->type == 2)
                                <video controls style="width:100%;">
                                    <source src="{{{ asset($attachment->media->link) }}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($attachment->media->type == 3)
                                <a target="_blank" href="{{{ asset($attachment->media->link) }}}">Download Attachment</a>
                            @endif
                        @endforeach
                    @endif
                @else
                <br>
                    <div style="">
                       {{{ $post->sharedPost->content }}}
                    </div>
                    <div style="border: 1px solid #ccc; margin: 3px; padding: 5px;">
                        {{{ $post->sharedPost->originalPost->originalPost->content }}}
                    </div>


                    @if($post->sharedPost->originalPost->attachments->count())
                        @foreach($post->sharedPost->originalPost->attachments as $attachment)
                            @if($attachment->media->type == 1)
                                <img src="{{{ asset($attachment->media->link) }}}" style="width:100%;" alt=""/>
                            @elseif($attachment->media->type == 2)
                                <video controls style="width:100%;">
                                    <source src="{{{ asset($attachment->media->link) }}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($attachment->media->type == 3)
                                <a target="_blank" href="{{{ asset($attachment->media->link) }}}">Download Attachment</a>
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
            <div>
                <?php $liked = $post->likes->filter(function($like) {
                                  return $like->user_id == Auth::getUser()->id;
                              })->first(); ?>
                <a href="javascript:;" class="like_button" data-url="@if(!$liked) {{{ URL::route('likeStatus', ['id' => $post->id]) }}} @else {{{ URL::route('unlikeStatus', ['id' => $liked->id]) }}} @endif">@if($liked) Unlike @else Like @endif</a>
                <?php $shareId = $post->type==1?$post->id:$post->sharedPost->originalPost->id; ?>
                <a href="javascript:;" class="share" data-post-url="{{{ URL::route('shareStatus', ['id' => $shareId ]) }}}" data-toggle="modal" data-target="#shareModal">Share</a>
                @if($post->user_id == $user->id || Auth::getUser()->role_id == 1)
                <a href="{{{ URL::route('deleteStatus', ['id' => $post->id]) }}}" class="delete">Delete</a>
                @endif
            </div>
            <i class="fa fa-thumbs-o-up"> <span id="">{{{ $post->likes->count() }}}</span> Likes</i>
            {{--<i class="fa fa-share-square-o"></i> 6 Shares--}}
            <div class="post-comment-{{$post->id}}">
                @foreach($post->comments as $comment)
                <div class="media border-bottom margin-none bg-gray">
                    <a href="{{URL::Route('profile',$comment->user->id)}}" class="pull-left innerAll half">
                        @if($comment->user->profilePicture)
                        <img src="{{Croppa::url($comment->user->profilePicture->link, 25, 25, 'resize')}}" width="25px" class="media-object post_profile_picture">
                        @else
                        <img src="{{ asset('assets/image/avatar.jpg')}}" height="25px">
                        @endif
                    </a>
                    <div class="media-body innerTB" style="padding-top: 0px">
                        <a href="{{URL::Route('profile',$comment->user->id)}}" class="strong text-inverse">{{$comment->user->first_name}} {{$comment->user->last_name}}</a>
                        <small>{{ Carbon::parse($comment->created_at)->diffForHumans(Carbon::now()) }}</small>
                        <div> {{$comment->content}}</div>

                        @if($comment->user->id==Auth::user()->id)
                            <a href="javascript:;" data-url="{{URL::Route('editComment',$comment->id)}}" class="editComment" data-toggle="modal" data-target="#editCommentModal" data-comment="{{$comment->content}}"> Edit </a>
                            <a href="javascript:;" data-url="{{URL::Route('deleteComment',$comment->id)}}" class="deleteComment"> Delete </a>
                        @endif

                    </div>
                </div>
                @endforeach


            </div>
                <div class="media border-bottom margin-none bg-gray">
                    <a href="" class="pull-left innerAll half">
                        @if($user->profilePicture)
                            <img src="{{Croppa::url($user->profilePicture->link, 25, 25, 'resize')}}" width="25px" class="media-object post_profile_picture">
                        @else
                            <img src="{{ asset('assets/image/avatar.jpg')}}" height="25px">
                        @endif
                    </a>
                    <div class="media-body innerTB">
                        <form method="post" class="comment" action="{{URL::Route('addComment',$post->id)}}" data-post="{{$post->id}}">
                            <input name="comment" class="form-control col-md-12" type="text" placeholder="Write a comment..">
                        </form>
                    </div>
                </div>
        </div>


    </div>
    @endforeach
    <!-- posts ends -->

    {{$posts->links()}}

</div>
<div class="col-md-3">
    @if(isset($ads[0])) <a target="_blank" href="{{ URL::route('adClick', ['id' => $ads[0]['id']]) }}"><img width="200px;" src="{{ URL::asset($ads[0]['img']) }}" alt=""/></a> @endif
    @if($friendRequest->count() > 0)
    <div class="widget">
        <h5 class="innerAll margin-none border-bottom bg-gray">Recent News</h5>
        <div class="widget-body padding-none">
            @foreach($friendRequest as $request)
            <div class="media border-bottom innerAll margin-none">
                <a href="{{URL::Route('profile',['profile_id' => $request->user->id])}}">
                    <img src="@if($request->user->profilePicture) {{Croppa::url($request->user->profilePicture->link, 25, 25, 'resize')}} @else {{URL::asset('assets/image/avatar.jpg')}} @endif" class="pull-left media-object">
                </a>
                <div class="media-body">
                    <h5 class="margin-none"><a href="{{URL::Route('profile',['profile_id' => $request->user->id])}}" class="text-inverse">{{ucwords($request->user->first_name)}} {{ucwords($request->user->last_name)}}</a></h5>
                    <div class="btn-group">
                        <a type="button" style="font-weight: normal;font-size: 12px;" class="btn btn-primary" href="{{URL::route('confirmFriendRequest',['id' => $request->user->id])}}"><i class="fa fa-check"></i> Confirm</a>
                        <a type="button" style="font-weight: normal;font-size: 12px;" class="btn btn-default" href="{{URL::Route('cancelFriendRequest',['id' => $request->user->id])}}"><i class="fa fa-times"></i> Cancel</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="shareForm" action="" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Share Post</h4>
          </div>
          <div class="modal-body">
            <input class="form-control" placeholder="Your comment" id="shareComment" type="text" name="content" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Share</button>
          </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" id="editCommentForm" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"> Edit Comment </h4>
      </div>
      <div class="modal-body">
        <input type="text" id="editCommentValue" name="comment" class="form-control"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Submit" class="btn btn-success"/>
      </div>
  </form>
    </div>
  </div>
</div>


@stop




@section('footer_script')
@parent

<script>
    $('#upload').on('click',function(e){
        $('#file').trigger('click');
        e.preventDefault();
    });

    $('.like_button').click(function(){
        $(this).attr('id', 'like_button');
        $.post($(this).attr('data-url'))
        .done(function( data ) {
           if(data.message == 'Liked')
           {
             $('#like_button').html('Unlike');
             $('#like_button').parent().next().find('span').html(parseInt($('#like_button').parent().next().find('span').html()) + 1);
             $('#like_button').attr('data-url', data.url);
             $('#like_button').removeAttr('id');
           }
           else
           {
             $('#like_button').html('Like');
             $('#like_button').parent().next().find('span').html(parseInt($('#like_button').parent().next().find('span').html()) - 1);
             $('#like_button').attr('data-url', data.url);
             $('#like_button').removeAttr('id');
           }
        });
      });

      $('.comment').submit(function(e){
        var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            var postId = $(this).data('post');
            $(this).trigger("reset");
            $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    var comment = "<div class='media border-bottom margin-none bg-gray'><a href='' class='pull-left innerAll half'> @if($user->profilePicture) <img src='{{Croppa::url($user->profilePicture->link, 25, 25, 'resize')}}' width='25px' class='media-object post_profile_picture'> @else <img src='{{ asset('assets/image/avatar.jpg')}}' height='25px'> @endif </a> <div class='media-body innerTB' style='padding-top: 0px'> <a href='' class='strong text-inverse'>{{$user->first_name}} {{$user->last_name}}</a> <br>"+postData[0]['value']+" <br> <a href='javascript:;' href='javascript:;' data-url='"+"{{URL::to('/')}}/comment/"+data+"/edit' class='editComment' data-toggle='modal' data-target='#editCommentModal' data-comment='"+postData[0]['value']+"'>Edit</a> <a href='javascript:;' data-url='"+"{{URL::to('/')}}/comment/"+data+"/delete' class='deleteComment'>Delete</a> </div> </div>";
                    $('.post-comment-'+postId).append(comment);

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('failed');
                }
            });
            e.preventDefault(); //STOP default action
            e.unbind(); //unbind. to stop multiple form submit.
      });

      $('.share').click(function(){
        $('#shareForm').attr('action', $(this).data('post-url'));
      });

      $('body').on('click','.editComment',function(){

            $('#editCommentForm').attr('action',$(this).data('url'));

            $('#editCommentValue').val($(this).data('comment'));

      });

      $('body').on('click','.deleteComment',function(){

              $(this).parent().parent().hide();

             $.ajax( $(this).data('url') ).done(function(){
                                                         })
                                                         .fail(function() {
                                                         });
                        });







</script>

@stop