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
            'cols'=>'required|numeric|max_length[2]'
        ];

        $msg =[
            'genre'=>[
                'required'=>'Genre Tidak Boleh Kosong',
                'alpha'=>'Genre Harus Berupa Huruf',
                'max'=>'Genre Tidak Boleh Melebihi 50 Karakter'
            ],
            'cols'=>[
                'required'=>'Cols Tidak Boleh Kosong',
                'numeric'=>'Cols Harus Berupa Angka',
                'max'=>'Cols Tidak Boleh Melebihi 2 Karakter'
            ]
        ];

        if (!$this->validate($rules,$msg)) {
            $error = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', $error);
        }

        $data = [
            'genre'=>$this->request->getPost('genre'),
            'cols'=>$this->request->getPost('cols')
        ];

        $addGenre = $this->genreModel->addGenre($data);
       
        if($addGenre){
            return redirect()->to('admin/genre-data')->with('success','Genre Berhasil di tambahakan');
        }else{
            return redirect()->to('admin/genre-data')->with('error','Genre Gagal di tambahakan');
        }
    }

    public function genreView(){
        $title = 'Data Genre';
        $data = $this->genreModel->getGenre();

        return view('genre/data-genre',['data'=>$data,'title'=>$title]);
    }


    public function deleteGenre($id)
    {
        $delete = $this->genreModel->deleteGenre($id);
        if(!$delete){
            return redirect()->to('admin/genre-data')->with('error','Data Genre Gagal Di Hapus');
        }

        // Redirect to page
        return redirect()->to('admin/genre-data')->with('success', 'Data Genre Berhasil Di Hapus');
    }

    public function editGenre(){
        $id = $this->request->getPost('id');
        $data= $this->genreModel->editGenre($id);
        return view('genre/edit-genre',['data'=>$data]);
    }

    public function updateGenre(){

        $rules = [
            'genre' => 'required|alpha|max_length[50]',
            'cols'=>'required|numeric|max_length[2]'
        ];

        $msg =[
            'genre'=>[
                'required'=>'Genre Tidak Boleh Kosong',
                'alpha'=>'Genre Harus Berupa Huruf',
                'max'=>'Genre Tidak Boleh Melebihi 50 Karakter'
            ],
            'cols'=>[
                'required'=>'Cols Tidak Boleh Kosong',
                'numeric'=>'Cols Harus Berupa Angka',
                'max'=>'Cols Tidak Boleh Melebihi 2 Karakter'
            ]
        ];

        if (!$this->validate($rules,$msg)) {
            $error = $this->validator->getErrors();
            return redirect()->to('admin/genre-data')->withInput()->with('error', $error);
        }

        $id= $this->request->getPost('id');
        $data = [
            'genre'=>$this->request->getPost('genre'),
            'cols'=>$this->request->getPost('cols')
        ];

        $update = $this->genreModel->updateGenre($id,$data);
        if(!$update){
            return redirect()->to('admin/genre-data')->with('error','Data Genre Gagal Di Hapus');
        }

        // Redirect to page
        return redirect()->to('admin/genre-data')->with('success', 'Data Genre Berhasil Di Hapus');
    }
}
