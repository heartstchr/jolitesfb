<?php

use Facebook\Repositories\Eloquent\AlbumRepository;
use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;

class AlbumController extends \BaseController {


    /**
     * @var Facebook\Repositories\Eloquent\AlbumRepository
     */
    private $album;
    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    private $user;

    function __construct(AlbumRepository $album,SiteSettingsRepository $siteSettings)
    {
        parent::__construct($siteSettings);
        $this->album = $album;
    }

    public function newalbum()
    {
        $id = $this->album->create(Input::get('album_name'));
        return Redirect::route('album',['profile_id'=>Auth::user()->id,'album_id' => $id]);
    }

    public function album($profile_id,$album_id)
    {
        $user = Auth::user();
        if($profile_id)
        {
            $this->layoutData['user'] = User::where('id',$user->id)->with(['profilePicture','coverPicture'])->first();

            if($user->id == $profile_id)
            {
                $this->layoutData['photos'] = Media::where('album_id',$album_id)->get();
                $this->layoutData['album_id'] = $album_id;
                return View::make('myphotos',$this->layoutData);
            }
            else
            {
                $this->layoutData['user1'] = User::where('id',$profile_id)->with(['profilePicture','coverPicture'])->first();
                $this->layoutData['photos'] = Media::where('album_id',$album_id)->get();
                return View::make('photos',$this->layoutData);
            }
        }
        return Redirect::back();
    }

    public function uploadPhotos($album_id)
    {
        $user = Auth::user();
        if($user)
        {
            if(Input::hasFile('photos'))
            {
                foreach(Input::file('photos') as $photo)
                {
                    $image = $photo;
                    $filename = str_random(32) . ".jpg";
                    $image->move('uploads', $filename);
                    $media = new Media;
                    $media->album_id = $album_id;
                    $media->type = 1;
                    $media->link = "uploads/" . $filename;
                    $media->save();
                }
            }
        }
        return Redirect::back();
    }

}