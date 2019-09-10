<?php


namespace App\Repositories\Eloquent;


use App\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepositoryEloquent extends RepositoryEloquent implements PostRepositoryInterface
{
    protected $userLogin;

    public function getModel()
    {
        return Post::class;
    }

    public function getUserLogin()
    {
        $this->userLogin = Auth::user();
        return $this->userLogin;
    }

    public function getAllOfUserLogin()
    {
        $column = "user_id";
        $keyword = $this->getUserLogin()->id;
        return $this->search($column, $keyword);
    }

    public function getPostOfNumber($number)
    {
        return $this->model->paginate($number);
    }

    public function getPostTopView()
    {
        return $this->model->orderBy('view', 'desc')->paginate(6);
    }
}
