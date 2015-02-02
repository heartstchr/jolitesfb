<?php


namespace Facebook\Repositories\Eloquent;


use Album;
use Facebook\Repositories\AlbumRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AlbumRepository extends AbstractRepository implements AlbumRepositoryInterface {

    protected $model;

    public function __construct(\Album $model)
    {
        $this->model = $model;
    }

    /**
     * Creates default album for logged in user
     *
     * @return bool
     */
    public function createDefault()
    {
        $album = Album::where('user_id',Auth::user()->id)->first();
        if(!$album){
            $profilePicture = new Album;
            $profilePicture->user_id = Auth::user()->id;
            $profilePicture->label = "profile";
            $profilePicture->save();

            $coverPicture = new Album;
            $coverPicture->user_id = Auth::user()->id;
            $coverPicture->label = "cover";
            $coverPicture->save();

            $timelinePicture = new Album;
            $timelinePicture->user_id = Auth::user()->id;
            $timelinePicture->label = "timeline";
            $timelinePicture->save();

            $videos = new Album;
            $videos->user_id = Auth::user()->id;
            $videos->label = "video";
            $videos->save();
        }

    }

    /**
     * Find album by name
     *
     * @param string $data
     * @return \Illuminate\Database\Eloquent\Collection|\Album
     */
    public function find($data)
    {
        return $this->model->where('user_id',Auth::user()->id)->where('label',$data)->first();
    }

    /**
     * Create album for logged in user
     *
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $album = new $this->model;
        $album->user_id = Auth::user()->id;
        $album->label = $data;
        $album->save();
        return $album->id;
    }
}