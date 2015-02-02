<?php


namespace Facebook\Repositories\Eloquent;


use Attachment;
use Facebook\Repositories\AttachmentRepositoryInterface;

class AttachmentRepository extends AbstractRepository implements AttachmentRepositoryInterface {

    protected $model;

    public function __construct(\Attachment $model)
    {
        $this->model = $model;
    }

    /**
     * Create a attachment object
     *
     * @param $data
     *
     * @return \Attachment|mixed
     */
    public function create($data)
    {

        $attachment = new Attachment;
        $attachment->post_id = $data['post_id'];
        $attachment->media_id = $data['media_id'];
        $attachment->save();

        return $attachment;
    }
}