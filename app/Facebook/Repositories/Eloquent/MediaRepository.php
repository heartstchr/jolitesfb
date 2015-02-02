<?php


namespace Facebook\Repositories\Eloquent;

use Facebook\Repositories\file;
use Facebook\Repositories\MediaRepositoryInterface;
use Facebook\Repositories\AlbumRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Media;
use User;


class MediaRepository extends AbstractRepository implements MediaRepositoryInterface {

    protected $model;

    /**
     * @var AlbumRepository
     */
    protected  $album;

    function __construct(User $model, AlbumRepositoryInterface $album)
    {
        $this->model = $model;
        $this->album = $album;
    }


    /**
     * uploads and sets an image as profile picture
     *
     * @param file $data
     * @return bool
     */
    public function profilePicture($data)
    {
        $album = $this->album->find('profile');

        $image = Input::file('fileInput');
        $filename = str_random(32).".jpg";
        $image->move('uploads', $filename);
        $media = new Media;
        $media->album_id = $album->id;
        $media->type = 1;
        $media->link = "uploads/".$filename;
        $media->save();
        $album->touch();
        $this->model->where('id',Auth::user()->id)->update(['profile_pic'=>$media->id]);
        return $filename;
    }

    /**
     * uploads and sets an image as cover picture
     *
     * @param file $data
     * @return bool
     */
    public function coverPicture($data)
    {
        $album = $this->album->find('cover');

        $image = Input::file('fileInput');
        $filename = str_random(32) . ".jpg";
        $image->move('uploads', $filename);
        $media = new Media;
        $media->album_id = $album->id;
        $media->type = 1;
        $media->link = "uploads/" . $filename;
        $media->save();
        $album->touch();
        $this->model->where('id', Auth::user()->id)->update(['cover_pic' => $media->id]);
        return $filename;
    }

    /**
     * Create a image media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createImage($data)
    {
        $album = $this->album->find('timeline');

        $image = $data['image'];
        $filename = str_random(32).".".$image->getClientOriginalExtension();
        $image->move('uploads',$filename);
        $media = new Media;
        $media->album_id = $album->id;
        $media->type = 1;
        $media->link = "uploads/".$filename;
        $media->save();
        $album->touch();

        return $media;
    }

    /**
     * Create a video media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createVideo($data)
    {

        $album = $this->album->find('video');

        $video = $data['video'];
        $filename = str_random(32).".".$video->getClientOriginalExtension();
        $video->move('uploads', $filename);
        $media = new Media;
        $media->album_id = $album->id;
        $media->type = 2;
        $media->link = "uploads/".$filename;
        $media->save();
        $album->touch();

        return $media;
    }

    /**
     * Create a file media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createFile($data)
    {

        $album = $this->album->find('timeline');

        $file = $data['file'];
        $filename = str_random(32).".".$file->getClientOriginalExtension();
        $file->move('uploads', $filename);
        $media = new Media;
        $media->album_id = $album->id;
        $media->type = 3;
        $media->link = "uploads/".$filename;
        $media->save();
        $album->touch();

        return $media;
    }
}