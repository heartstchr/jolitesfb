<?php


namespace Facebook\Repositories;


interface MediaRepositoryInterface {

    /**
     * uploads and sets an image as profile picture
     *
     * @param file $data
     * @return bool
     */
    public function profilePicture($data);

    /**
     * Create a image media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createImage($data);

    /**
     * Create a video media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createVideo($data);

    /**
     * Create a file media object
     *
     * @param $data
     *
     * @return mixed
     */
    public function createFile($data);

    /**
     * uploads and sets an image as cover picture
     *
     * @param file $data
     * @return bool
     */
    public function coverPicture($data);

}