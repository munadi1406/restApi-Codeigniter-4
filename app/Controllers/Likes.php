<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LikesModel;
use CodeIgniter\API\ResponseTrait;

class Likes extends BaseController
{
    private $LikesModel;

    use ResponseTrait;
    public function __construct()
    {
        $this->LikesModel = new LikesModel();
    }

    public function index(){

        $dataLike = $this->LikesModel->getDataLike();
        return view('like/index',['data'=>$dataLike]);
    }

    public function like(){
        $film_id = $this->request->getVar('film_id');
        $user_id = $this->request->getVar('user_id');
        $data = [
            'film_id'=>$film_id,
            'user_id'=>$user_id
        ];
        $checkLike = $this->LikesModel->checkLike($film_id,$user_id);
        if($checkLike){
            $this->LikesModel->deleteLike($checkLike['id_like']);
            return $this->respond()->setStatusCode(200);
        }
        $this->LikesModel->like($data);
        return $this->respond()->setStatusCode(201);
    }

    public function checkLike(){
        $film_id = $this->request->getVar('film_id');
        $user_id = $this->request->getVar('user_id');
        $checkLike = $this->LikesModel->checkLike($film_id,$user_id);
        if($checkLike){
            return $this->respond(['status'=>true])->setStatusCode(200);
        }else{
            return $this->respond(['status'=>false])->setStatusCode(404);
        }
    }

    public function getLikeById($film_id){

        $likeById = $this->LikesModel->getLikeByFilmId($film_id);
        if($likeById){
            return $this->respond(['like'=>$likeById['film_id']])->setStatusCode(200);
        }else{
            return $this->respond(['like'=>0])->setStatusCode(200);
        }
    }
}
