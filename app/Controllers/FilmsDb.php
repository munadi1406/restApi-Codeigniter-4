<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EpisodeModel;
use App\Models\FilmsModel;
use App\Models\LinkModel;
use App\Models\ViewsModel;
use App\Models\GenreModel;
use CodeIgniter\API\ResponseTrait;



class FilmsDb extends BaseController
{

    protected $episodeModel;
    protected $filmsModel;
    protected $linkModel;
    protected $viewsModel;
    protected $genreModel;
    protected $session;
    use ResponseTrait;
    // load session library

    public function __construct()
    {
        $this->episodeModel = new EpisodeModel();
        $this->filmsModel = new FilmsModel();
        $this->linkModel = new LinkModel();
        $this->viewsModel = new ViewsModel();
        $this->genreModel = new GenreModel();
        $this->session = \Config\Services::session();
    }

    public function films()
    {
       
        $countPost = $this->filmsModel->countFilms();
        $countPostShow = $this->filmsModel->countFilmsShow();
        $countPostMovie = $this->filmsModel->countFilmsMovie();
        $countPostSeries = $this->filmsModel->countFilmsSeries();

        $data = [
            'countpost' => $countPost,
            'countpostshow' => $countPostShow,
            'countpostseries' => $countPostSeries,
            'countpostmovie' => $countPostMovie,
        ];


        return view('home/home', ['data' => $data]);
    }



    public function postAdd()
    {
        // all films
        $data = $this->filmsModel->filmsAll();

        return view('post/add-post', ['data' => $data]);
    }


    public function postView()
    {
        // all films
        $filmsAll = $this->filmsModel->filmsAll();


        $filmsLink = $this->filmsModel->filmsLink();
        $LinkSeries = $this->filmsModel->filmsLinkSeries();

        return view('post/data-post', ['data' => $filmsAll, 'link' => $filmsLink, 'linkseries' => $LinkSeries]);
    }

    public function filmsInsert()
    {


        $rules = [
            'title' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            'tipe' => 'required|in_list[Movie,Series]',
            'desc' => 'required',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        



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



        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();



        $imageUrl = base_url('images/' . $imageName);
        $filmData = [
            'id_users' => 3,
            'title' => $this->request->getVar('title'),
            'desc' => $this->request->getVar('desc'),
            'date' => $this->request->getVar('date'),
            'image' => $imageUrl,
            'tipe' => $this->request->getVar('tipe'),
            'status' => 'show',
            'subtitle' => $this->request->getVar('subtitle'),
            'trailer' => $this->request->getVar('trailer')


        ];
        $genre = $this->request->getPost('genre');
        if (is_array($genre)) {
            $genre = implode(',', $genre);
        } else {
            $genre = '';
        }



        $titleCheck = $this->filmsModel->where('title', $filmData['title'])->first();


        if ($titleCheck) {
            session()->setFlashdata('error', 'Nama Sudah Tidak Tersedia');
            return redirect()->back()->withInput();
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

        // Set flash message
        $this->session->setFlashdata('success_message', 'Postingan berhasil disimpan.');

        // Redirect to page
        return redirect()->route('admin/post-data');

    }
}