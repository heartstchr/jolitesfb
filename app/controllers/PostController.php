<?php

use Facebook\Repositories\Eloquent\MediaRepository;
use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;
use Facebook\Repositories\Eloquent\PostRepository;

class PostController extends \DashController {

    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    protected  $user;

    /**
     * @var Facebook\Repositories\Eloquent\SiteSettingsRepository
     */
    protected  $siteSettings;
    /**
     * @var Facebook\Repositories\Eloquent\PostRepository
     */
    protected  $post;
    /**
     * @var MediaRepository
     */
    private $media;
    /**
     * @var \Facebook\Repositories\Eloquent\AttachmentRepository
     */
    private $attachment;

    /**
     * @param UserRepository $user
     * @param SiteSettingsRepository $siteSettings
     * @param PostRepository $post
     * @param MediaRepository $media
     * @param \Facebook\Repositories\Eloquent\AttachmentRepository $attachment
     */
    function __construct(UserRepository $user,SiteSettingsRepository $siteSettings, PostRepository $post, MediaRepository $media, \Facebook\Repositories\Eloquent\AttachmentRepository $attachment)
    {
        parent::__construct($user,$siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
        $this->post = $post;
        $this->media = $media;
        $this->attachment = $attachment;
    }

    public function addStatus()
    {
        $data = Input::all();
        $data['type'] = 1;
        $data['user_id'] = Auth::user()->id;

        if($post = $this->post->create($data))
        {
            if(Input::hasFile('file'))
            {
                foreach(Input::file('file') as $file)
                {
                    if(strstr($file->getMimeType(), "video/")){
                        $data['video'] = $file;
                        $media = $this->media->createVideo($data);
                    }else if(strstr($file->getMimeType(), "image/")){
                        $data['image'] = $file;
                        $media = $this->media->createImage($data);
                    }else {
                        $data['file'] = $file;
                        $media = $this->media->createFile($data);
                    }
                }
                $data['post_id'] = $post->id;
                $data['media_id'] = $media->id;
                $attachment = $this->attachment->create($data);
            }
            return Redirect::back()->with('success', 'Post created successfully');
        }
        else
        {
            return Redirect::back()->with('error', 'Error creating post');
        }
    }

    public function deleteStatus($id)
    {
        $post = Post::where('id', $id)->with('originalPost', 'sharedPost', 'attachments')->first();

        if($post->type == 1)
            $post->originalPost->delete();
        else
            $post->sharedPost->delete();

        foreach($post->attachments as $attachment)
        {
            $attachment->delete();
        }

        $post->delete();

        return Redirect::back()->with('success', 'Post deleted successfully');
    }

    public function likeStatus($id)
    {

        $user = Auth::user();
        $post = Post::find($id);

        $like = $post->likes()->create(['user_id' => $user->id]);

        $author = $post->user;

        if($author->id != $user->id) {
            $notification_content = [
                'link' => URL::route('profile', ['profile_id' => $user->id]),
                'message' => $user->first_name . ' ' . $user->last_name . ' has liked your post.',
            ];

            if ($user->profilePicture) {
                $notification_content['image_path'] = $user->profilePicture->link;
            }

            $notification = new Notification();
            $notification->user_id = $author->id;
            $notification->is_read = 0;
            $notification->content = json_encode($notification_content);
            $notification->save();
        }

        return Response::json(['message' => 'Liked', 'url' => URL::route('unlikeStatus', ['id' => $like->id])]);

    }

    public function unlikeStatus($id)
    {

        $like = Like::find($id);
        $post_id = $like->likeable_id;

        $like->delete();

        return Response::json(['message' => 'Unliked', 'url' => URL::route('likeStatus', ['id' => $post_id])]);
    }


    public function addComment($id){

        $post = Post::find($id);
        $user= Auth::user();

        $data = $post->comments()->create(['content'=>Input::get('comment'),'user_id'=>$user->id]);

        $author = $post->user;

        if($author->id != $user->id) {
            $notification_content = [
                'link' => URL::route('profile', ['profile_id' => $user->id]),
                'message' => $user->first_name . ' ' . $user->last_name . ' has commented on your post.',
            ];

            if ($user->profilePicture) {
                $notification_content['image_path'] = $user->profilePicture->link;
            }

            $notification = new Notification();
            $notification->user_id = $author->id;
            $notification->is_read = 0;
            $notification->content = json_encode($notification_content);
            $notification->save();
        }

        return $data->id;
    }

    public function sharePost($id)
    {
        $original_post = Post::find($id);
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $post->type = 2;
        $post->save();

        $shared_post = new Shared_post;
        $shared_post->post_id = $post->id;
        $shared_post->original_post_id = $original_post->id;
        $shared_post->content = Input::get('content');
        $shared_post->save();

        $author = $original_post->user;

        if($author->id != $user->id) {
            $notification_content = [
                'link' => URL::route('profile', ['profile_id' => $user->id]),
                'message' => $user->first_name . ' ' . $user->last_name . ' has shared your post.',
            ];

            if ($user->profilePicture) {
                $notification_content['image_path'] = $user->profilePicture->link;
            }

            $notification = new Notification();
            $notification->user_id = $author->id;
            $notification->is_read = 0;
            $notification->content = json_encode($notification_content);
            $notification->save();
        }

        return Redirect::back()->with('success', 'Post shared successfully.');
    }

    public function deleteComment($id){

        $comment = Comment::where('id',$id)->delete();

        return "success";

    }

    public function editComment($id){


        $comment = Comment::find($id);

        $comment->content = Input::get('comment');

        $comment->save();




        return Redirect::back()->withSuccess('Comment added successfully');
    }

}