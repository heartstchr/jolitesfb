<?php


namespace Facebook\Repositories;


interface AttachmentRepositoryInterface {

    /**
     * Create a attachment object
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data);
}