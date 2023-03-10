<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EpisodeModel;
use App\Models\FilmsModel;
use App\Models\LinkModel;
use App\Models\ViewsModel;
use App\Models\GenreModel;
use App\Models\LogModel;

use CodeIgniter\API\ResponseTrait;
use Config\Services;


class FilmsDb extends BaseController
{

    private $episodeModel;
    private $filmsModel;
    private $linkModel;
    private $viewsModel;
    private $genreModel;
    private $logModel;

    private $session;
    private $os;
    private $browser;

    private $encrypter;
    use ResponseTrait;

    public function __construct()
    {
        $this->episodeModel = new EpisodeModel();
        $this->filmsModel = new FilmsModel();
        $this->linkModel = new LinkModel();
        $this->viewsModel = new ViewsModel();
        $this->genreModel = new GenreModel();
        $this->session = \Config\Services::session();
        $this->encrypter = Services::encrypter();
        $this->logModel = new LogModel();


        $this->os = $this->logModel->operatingSystem();
        $this->browser = $this->logModel->browser();
    }

    public function films()
    {

        // title page
        $title = 'Home';

        $countPost = $this->filmsModel->countFilms();
        $countPostShow = $this->filmsModel->countFilmsShow();
        $countPostMovie = $this->filmsModel->countFilmsMovie();
        $countPostSeries = $this->filmsModel->countFilmsSeries();
        
        $data = [
            'countpost' => $countPost,
            'countpostshow' => $countPostShow,
            'countpostseries' => $countPostSeries,
            'countpostmovie' => $countPostMovie,
            'browser'=>$this->browser,
            'os'=>$this->os
        ];
        return view('home/home', ['data' => $data,'title'=>$title]);
    }



    public function postAdd()
    {
        // title
        $title = "Films Add";


        return view('post/add-post', ['title'=>$title]);
    }


    public function postView()
    {

        // title
        $title = "Films Data";

        // all films
        $filmsAll = $this->filmsModel->filmsAll();


        $filmsLink = $this->filmsModel->filmsLink();
        $LinkSeries = $this->filmsModel->filmsLinkSeries();

        return view('post/data-post', ['data' => $filmsAll, 'link' => $filmsLink, 'linkseries' => $LinkSeries,'title'=>$title]);
    }

    public function filmsInsert()
    {

        // deskirpsi id
        $idEnkripsi = session('uid');
        $key = $_ENV['KEY'];
        $salt = $_ENV['SALT'];
        $idDeskripsi = $this->encrypter->decrypt($idEnkripsi,$key);
        $idUsers = substr($idDeskripsi, strlen($salt), 2);


        $rules = [
            'title' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            'tipe' => 'required|in_list[Movie,Series]',
            'desc' => 'required',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            $error = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error',$error);
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
            'id_users' => $idUsers,
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
            return redirect()->back()->withInput()->with('error','Nama Sudah Tidak Tersedia');
        }

        if (!$quality1080 && !$quality720 && !$quality540) {
            return redirect()->back()->withInput()->with('error','Silahkan Pilih Quality Minimal 1');
        }

        if (!$gd1080 && !$utb1080 && !$mg1080 && !$gd720 && !$utb720 && !$mg720 && !$gd540 && !$utb540 && !$mg540) {
            return redirect()->back()->withInput()->with('error','isi link minimal 1 berdasarkan quality');
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
            if (!$gd1080 && !$utb1080 && !$mg1080) {
                return redirect()->back()->withInput()->with('error','isi link minimal 1 berdasarkan quality');
            }
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
            if (!$gd720 && !$utb720 && !$mg720) {
                return redirect()->back()->withInput()->with('error','isi link minimal 1 berdasarkan quality');
            }
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
            if (!$gd540 && !$utb540 && !$mg540) {
                return redirect()->back()->withInput()->with('error','isi link minimal 1 berdasarkan quality');
            }
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
        return redirect()->route('admin/post-data')->with('success','Film Berhasil Di Posting');
    }

    //menadpatkan data films
    public function filmsEdit()
    {

        $filmId = $this->request->getPost('film_id');

        $data = $this->filmsModel->filmsEdit($filmId);

        $title = "Edit-".$data['title'];

        $link = $this->linkModel->linkEdit($filmId);

        return view('post/edit-post', ['data' => $data, 'link' => $link,'title'=>$title]);
    }

    // eksekusi edit film
    public function edit()
    {
        $film_id = $this->request->getPost('film_id');
        $imageBefore = $this->request->getPost('imageBefore');



        $rules = [
            'image' => 'uploaded[image]',
        ];

        $image = $this->request->getFile('image');
        if (!$this->validate($rules)) {
            $imageUrl = $imageBefore;
        } else {
            $rulesImage = [
                'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            ];
            if ($this->validate($rulesImage)) {
                $imageName = $image->getRandomName();
                $imageUrl = base_url('images/' . $imageName);
                if ($imageBefore) {
                    $path = ROOTPATH . 'writable/uploads/' . basename($imageBefore);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                } else {
                    return false;
                }
                $image->move(ROOTPATH . 'writable/uploads', $imageName);
            } else {
                session()->setFlashdata('error', $this->validator->getErrors());
                return redirect('admin/post-data');
            }
        }


        $dataFilm = [
            'title' => $this->request->getPost('title'),
            'desc' => $this->request->getPost('desc'),
            'date' => $this->request->getPost('date'),
            'image' => $imageUrl,
            'trailer' => $this->request->getPost('trailer'),
            'subtitle' => $this->request->getPost('subtitle'),
        ];

        $genre = $this->request->getPost('genre');
        if (is_array($genre)) {
            $genre = implode(',', $genre);
        } else {
            $genre = '';
        }

        $data = $this->filmsModel->filmEdit($film_id, $dataFilm);

        $dataGenre = [
            'name'=>$genre,
        ];
        $dataGenre = $this->genreModel->genreUpdate($film_id,$dataGenre);

        if (!$data && $dataGenre) {
            session()->setFlashdata('error', 'Data Gagal Di Upadate');
            return redirect()->route('admin/post-data');
        } 
        session()->setFlashdata('success_message', 'Data Berhasil Di Upadate');
        return redirect()->route('admin/post-data');
    }

    public function filmsDelete($filmId)
    {
        $data = $this->filmsModel->deleteFilmsPost($filmId);

        if ($data) {
            return redirect()->route('admin/post-data')->with('success','Postingan Berhasil Di Hapus');
        } else {
            return redirect()->route('admin/post-data')->with('success','Postingan Gagal Di Hapus');
        }
        // Redirect to page
    }



    public function episode()
    {


        $filmId = $this->request->getPost('film_id');
        $data = $this->episodeModel->episodeByFilmid($filmId);

        $title = "Add-Eps-". $data['title'];

        return view('post/add-episode', ['data' => $data,'title'=>$title]);
    }


    public function addEpisode()
    {
        $filmId = $this->request->getPost('film_id');
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
        $episode = $this->request->getVar('episode');

        $episodeData = [
            'film_id' => $filmId,
            'episode' => $episode
        ];

        $episode = $this->episodeModel->episodeInsert($episodeData);
        $linkData = [];
        if ($quality1080 === '1080') {
            if (!$gd1080 && !$utb1080 && !$mg1080) {
                session()->setFlashdata('error', 'isi link minimal 1 berdasarkan quality');
                return redirect()->back()->withInput();
            }
            $linkData[] = [
                'film_id' => $filmId,
                'episode_id' => $episode,
                'GD' => $gd1080,
                'UTB' => $utb1080,
                'MG' => $mg1080,
                'quality' => '1080'
            ];
        }
        if ($quality720 === '720') {
            if (!$gd720 && !$utb720 && !$mg720) {
                session()->setFlashdata('error', 'isi link minimal 1 berdasarkan quality');
                return redirect()->back()->withInput();
            }
            $linkData[] = [
                'film_id' => $filmId,
                'episode_id' => $episode,
                'GD' => $gd720,
                'UTB' => $utb720,
                'MG' => $mg720,
                'quality' => '720'
            ];
        }
        if ($quality540 === '540') {
            if (!$gd540 && !$utb540 && !$mg540) {
                session()->setFlashdata('error', 'isi link minimal 1 berdasarkan quality');
                return redirect()->back()->withInput();
            }
            $linkData[] = [
                'film_id' => $filmId,
                'episode_id' => $episode,
                'GD' => $gd540,
                'UTB' => $utb540,
                'MG' => $mg540,
                'quality' => '540'
            ];
        }
        // insert

        $data = $this->linkModel->linkInsert($linkData);


        if ($data && $episode) {
            $this->session->setFlashdata('success_message', 'Episode Berhasil Di Post.');
            return redirect()->route('admin/post-data');
        } else {
            $this->session->setFlashdata('error', 'Episode Gagal Di Add');
            return redirect()->route('admin/post-data');
        }
    }



    // untuk menampilkan data link
    public function link()
    {
        
        $filmId = $this->request->getPost('film_id');


        $data = $this->filmsModel->filmsEdit($filmId);
        $link = $this->linkModel->linkEdit($filmId);

        $title = "Edit-".$data['title'];

        return view('link/edit-link', ['data' => $data, 'link' => $link,'title'=>$title]);
    }


    public function linkEdit()
    {
        $id_link = $this->request->getPost('id_link');
        $filmId = $this->request->getPost('film_id');
        $title = $this->request->getPost('title');

        $linkData = [
            "GD" => $this->request->getPost('gd'),
            "UTB" => $this->request->getPost('utb'),
            "MG" => $this->request->getPost('mg')
        ];



        $data = $this->linkModel->editLink($id_link, $linkData);
        if ($data) {
            session()->setFlashdata('success', 'link Dengan title ' . $title . ' berhasil di edit');
            return view('link/redirect-link', ['film_id' => $filmId]);
        } else {
            session()->setFlashdata('error', 'link Dengan title ' . $title . ' Gagal di edit');
            return view('link/redirect-link', ['film_id' => $filmId]);
        }
    }

    public function filmsByMovie(){
        // title
        $title = "Movie Data";
        // all films
        $filmsAll = $this->filmsModel->filmsByTipe('Movie');
    
        $filmsLink = $this->filmsModel->filmsLink();
        $LinkSeries = $this->filmsModel->filmsLinkSeries();
    
        return view('post/data-movie', ['data' => $filmsAll, 'link' => $filmsLink, 'linkseries' => $LinkSeries,'title'=>$title]);
    }


    public function filmsBySeries(){
        // title
        $title = "Series Data";
        // all films
        $filmsAll = $this->filmsModel->filmsByTipe('Series');
    
        $filmsLink = $this->filmsModel->filmsLink();
        $LinkSeries = $this->filmsModel->filmsLinkSeries();
    
        return view('post/data-series', ['data' => $filmsAll, 'link' => $filmsLink, 'linkseries' => $LinkSeries,'title'=>$title]);
    }


    public function updateStatus(){
        $filmId = $this->request->getVar('film_id');
        $status = $this->request->getVar('status');


        if($status ==='show'){
            $statusChange = "deleted";
        }elseif($status==='deleted'){
            $statusChange = 'show';
        }

        $data = [
            'status'=>$statusChange
        ];

        $updateStatus = $this->filmsModel->updateStatus($filmId,$data);

        if($updateStatus){
            return redirect()->back()->with('success_message','Status Berhasil Di Ubah Ke '.$statusChange);
        }else{
            return redirect()->back()->with('error','Status Gagal Di Ubah ke'.$statusChange);
        }
    }
}
