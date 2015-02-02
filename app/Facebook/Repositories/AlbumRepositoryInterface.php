<?php


namespace Facebook\Repositories;


interface AlbumRepositoryInterface {

    /**
     * Create album for logged in user
     *
     * @param $data
     * @return bool
     */
    public function create($data);

    /**
     * Creates default album for logged in user
     *
     * @return bool
     */
    public function createDefault();

    /**
     * Find album by name
     *
     * @param string $data
     * @return \Illuminate\Database\Eloquent\Collection|\Album
     */
    public function find($data);

}