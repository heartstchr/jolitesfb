<?php


namespace Facebook\Repositories\Eloquent;

use Carbon\Carbon;
use Facebook\Repositories\PostRepositoryInterface;
use Post;
use Original_post;
use Shared_post;

class PostRepository extends AbstractRepository implements PostRepositoryInterface {

    protected $model;

    function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Create a post
     *
     * @param $data
     *
     * @return \Post
     */
    public function create($data)
    {

        $post = new Post;
        $post->user_id = $data['user_id'];
        $post->type = $data['type'];
        $post->save();

        if($post->type == 1)
        {
            $original_post = new Original_post;
            $original_post->post_id = $post->id;
            $original_post->content = $data['content'];
            $original_post->save();
        }
        else
        {
            $shared_post = new Shared_post;
            $shared_post->post_id = $post->id;
            $shared_post->original_post_id = $data['original_post_id'];
            $shared_post->content = $data['content'];
            $shared_post->save();
        }

        return $post;
    }

}