<?php namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Repositories\Repository;
use App\Post;

class PostRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Post::class;
    }

    public function all($columns = array('*')) {
        return $this->model->with('user')->get($columns);
    }

    public function find($id, $columns = array('*')) {
        return $this->model->with('user')->find($id, $columns);
    }
}