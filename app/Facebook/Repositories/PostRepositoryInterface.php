<?php


namespace Facebook\Repositories;


interface PostRepositoryInterface {

    /**
     * Create a post
     *
     * @param $data
     *
     * @return \Post
     */
    public function create($data);

}