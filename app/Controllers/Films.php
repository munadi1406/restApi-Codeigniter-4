<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\FilmsModel;
use App\Models\LinkModel;
use App\Models\GenreModel;
use App\Models\EpisodeModel;
use App\Models\ViewsModel;


class Films extends BaseController
{
    protected $filmsModel;
    protected $linkModel;
    protected $genreModel;
    protected $episodeModel;
    protected $viewsModel;


    use ResponseTrait;
    public function __construct()
    {
        $this->filmsModel = new FilmsModel();
        $this->linkModel = new LinkModel();
        $this->genreModel = new GenreModel();
        $this->episodeModel = new EpisodeModel();
        $this->viewsModel = new ViewsModel();
    }

    public function films($limit = 10, $offset = 0)
    {
        $datas = $this->filmsModel->getFilms($limit, $offset);
        $totalPost = $this->filmsModel->countAllResults();
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas,
                'total' => $totalPost
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }

    public function countFilms()
    {
        return $this->respond($this->filmsModel->countFilms());
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

    public function filmsByGenre($genre, $startFrom, $record)
    {
        $datas = $this->genreModel->genreFilter($genre, $startFrom, $record);
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

    public function countGenre($genre)
    {
        return $this->respond($this->genreModel->countGenre($genre));
    }

    public function filmsByType($type, $startFrom, $record)
    {
        $datas =  $this->filmsModel->filmsByType($type, $startFrom, $record);
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

    public function countType($type)
    {
        return $this->respond($this->filmsModel->countType($type));
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


        $genre  = $this->request->getVar('genre');


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


        $imageUrl = base_url('images/' . $imageName);
        $filmData = [
            'id_users' => $this->request->getVar('id_users'),
            'title' => $this->request->getVar('title'),
            'desc' => $this->request->getVar('desc'),
            'date' => $this->request->getVar('date'),
            'image' => $imageUrl,
            'tipe' => $this->request->getVar('tipe'),
            'status' => 'show',
            'subtitle' => $this->request->getVar('subtitle'),
            'trailer' => $this->request->getVar('trailer')
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


        // film insert
        $film = $this->filmsModel->insertFilms($filmData);
        $image->move(ROOTPATH . 'writable/uploads', $imageName);

        $episode = null;
        if ($filmData['tipe'] === 'Series') {
            $episodeData = [
                'film_id' => $film,
                'episode' => 1
            ];
            $episode = $this->episodeModel->episodeInsert($episodeData);
        }

        $linkData = [];
        if ($quality1080 === '1080') {
            $linkData[] = [
                'film_id' => $film,
                'episode_id' => $episode,
                'GD' => $gd1080,
                'UTB' => $utb1080,
                'MG' => $mg1080,
                'quality' => '1080'

            ];
        }
        if ($quality720 === '720') {
            $linkData[] = [
                'film_id' => $film,
                'episode_id' => $episode,
                'GD' => $gd720,
                'UTB' => $utb720,
                'MG' => $mg720,
                'quality' => '720'
            ];
        }
        if ($quality540 === '540') {
            $linkData[] = [
                'film_id' => $film,
                'episode_id' => $episode,
                'GD' => $gd540,
                'UTB' => $utb540,
                'MG' => $mg540,
                'quality' => '540'
            ];
        }

        // insert link
        $this->linkModel->linkInsert($linkData);



        // insert genre
        $genreData = [
            'name' => $genre,
            'id_films' => $film
        ];
        $this->genreModel->genreInsert($genreData);

        $dataViews = [
            'film_id' => $film,
            'views' => 0
        ];
        $this->viewsModel->viewsInsert($dataViews);


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
        header('Content-Type: ' . $info['mime']);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}
    public function deleteFilms($filmsId)
    {
        $film = $this->filmsModel->find($filmsId);
        if (!$film) {
            return $this->failNotFound('Data film tidak ditemukan');
        }

        $imagePath = WRITEPATH . 'uploads/' . basename($film['image']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // hapus data film
        $result = $this->filmsModel->deleteFilms($filmsId);
        if ($result) {
            return $this->respondDeleted(['message' => 'Success']);
        } else {
            return $this->fail('Gagal menghapus data film');
        }
    }


    public function getImageCache()
    {
        $datas = $this->filmsModel->getImageCache();
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


    public function updateViews($filmId)
    {
        $datas = $this->viewsModel->updateViews($filmId);
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
            ])->setStatusCode(200);
        } else {
            // return $this->respondUpdated($datas);
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }
    }




    public function getViews($filmId)
    {
        $datas = $this->viewsModel->getViews($filmId);
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


    public function getAllViews()
    {
        $datas = $this->viewsModel->getAllViews();
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

    public function filmsSearch()
    {
        $search = $this->request->getVar('search');


        $data = $this->filmsModel->searchFilms($search);

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'not found',
                'data' => $search
            ])->setStatusCode(404);
        }
    }
}
