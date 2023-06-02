<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenresModel;

class Genre extends BaseController
{
    private $genreModel;
    public function __construct()
    {
        $this->genreModel = new GenresModel();
    }
    public function index()
    {
        $title = 'Add Genre';
        return view('genre/add-genre', ['title' => $title]);
    }

    public function addGenre()
    {
        $rules = [
            'genre' => 'required|alpha|max_length[50]',
        ];

        $msg =[
            'genre'=>[
                'required'=>'Genre Tidak Boleh Kosong',
                'alpha'=>'Genre Harus Berupa Huruf',
                'max'=>'Genre Tidak Boleh Melebihi 50 Karakter'
            ]
        ];

        if (!$this->validate($rules,$msg)) {
            $error = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', $error);
        }

        $data = [
            'genre' => $this->request->getVar('genre')
        ];

        $addGenre = $this->genreModel->addGenre($data);
       
        if($addGenre){
            return redirect()->to('genre/data-genre')->with('success','Genre Berhasil di tambahakan');
        }else{
            return redirect()->to('genre/data-genre')->with('error','Genre Gagal di tambahakan');
        }
    }

    public function genreView(){
        $title = 'Data Genre';
        $data = $this->genreModel->getGenre();

        return view('genre/data-genre',['data'=>$data,'title'=>$title]);
    }
}
