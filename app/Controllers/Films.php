<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\FilmsModel;
use App\Models\LinkModel;
use App\Models\GenreModel;


class Films extends BaseController
{
    protected $filmsModel;
    protected $linkModel;
    protected $genreModel;
    use ResponseTrait;
    public function __construct()
    {
        $this->filmsModel = new FilmsModel();
        $this->linkModel = new LinkModel();
        $this->genreModel = new GenreModel();
    }

    public function films()
    {
        $datas = $this->filmsModel->films();
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }


    public function filmsById($id)
    {
        $datas = $this->filmsModel->filmsById($id);
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed',
                'data' => $datas
            ])->setStatusCode(404);
        }
    }

    public function filmsRandom()
    {
        $datas = $this->filmsModel->randomFilms();
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }

    public function filmsLink($id)
    {
        $datas = $this->linkModel->link($id);
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }

    public function filmsByGenre($genre)
    {
        $datas = $this->genreModel->genreSeacrh($genre);
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }


    public function filmsInsert()
    {
        $rules = [
            'id_users' => 'required',
            'title' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            'tipe' => 'required|in_list[Movie,Series]',
            'desc' => 'required',
            'date' => 'required|valid_date'
        ];

        $quality1080 = $this->request->getVar('quality1080');
        $gd1080 = $this->request->getVar('gd1080');
        $utb1080 = $this->request->getVar('utb1080');
        $mg1080 = $this->request->getVar('mg1080');
        $quality720 = $this->request->getVar('quality720');
        $gd720 = $this->request->getVar('gd720');
        $utb720 = $this->request->getVar('utb720');
        $mg720 = $this->request->getVar('mg720');
        $quality540 = $this->request->getVar('quality540');
        $gd540 = $this->request->getVar('gd540');
        $utb540 = $this->request->getVar('utb540');
        $mg540 = $this->request->getVar('mg540');


        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }


        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move(ROOTPATH . 'writable/uploads', $imageName);
        
        $imageUrl = base_url('images/' . $imageName);
        
        $filmData = [
            'id_users' => $this->request->getVar('id_users'),
            'title' => $this->request->getVar('title'),
            'desc' => $this->request->getVar('desc'),
            'date' => $this->request->getVar('date'),
            'image' => $imageUrl,
            'tipe' => $this->request->getVar('tipe'),
            'status' => 'show'
        ];
        
        $titleCheck = $this->filmsModel->where('title', $filmData['title'])->first();
        if (!empty($titleCheck)) {
            return $this->respond([
                'status' => 400,
                'error' => 400,
                'messages' => [
                    'title' => 'Nama Tidak Tersedia'
                ]
            ], 400);
        }

        $film = $this->filmsModel->insertFilms($filmData);

        $linkData = [];
        if ($quality1080 === '1080') {
            $linkData[] = [
                'film_id' => $film,
                'GD' => $gd1080,
                'UTB' => $utb1080,
                'MG' => $mg1080,
                'quality' => '1080'
            ];
        }
        if ($quality720 === '720') {
            $linkData[] = [
                'film_id' => $film,
                'GD' => $gd720,
                'UTB' => $utb720,
                'MG' => $mg720,
                'quality' => '720'
            ];
        }
        if ($quality540 === '540') {
            $linkData[] = [
                'film_id' => $film,
                'GD' => $gd540,
                'UTB' => $utb540,
                'MG' => $mg540,
                'quality' => '540'
            ];
        }
        $this->linkModel->linkInsert($linkData);
 
        return $this->respondCreated([
            'status' => 201,
            'message' => 'Data film berhasil disimpan',
            'data' => $film
        ]);
    }

    public function showImage($imageName)
    {
        $path = WRITEPATH . 'uploads/' . $imageName;
        if (file_exists($path)) {
            $info = getimagesize($path);
            header('Content-type: '.$info['mime']);
            readfile($path);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan: '.$imageName);
        }
    }

}
