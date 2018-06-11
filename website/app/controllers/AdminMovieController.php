<?php

class AdminMovieController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Assets::addCss(url()."/public/components/summernote/dist/summernote.css");
        Assets::add(url()."/public/components/summernote/dist/summernote.min.js");
        Assets::add(url()."/public/js/tai/taipages/movie.js");
        $data = array();
        $data['movie'] = Movie::getMovie();
        return View::make("admin.skin")->nest("content","admin.movie",$data);


	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $arr = array(
            "text" => Input::get("text"),
            "title" => Input::get("title"),
        );
        $image = Input::get("image");
        if(!empty($image))
        {
            $arr['image'] = createImage($image , "png");
        }
        $youtube = Input::get("youtube");
        if(!empty($youtube) && !is_numeric($youtube))
        {
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtube, $matches);
            if(isset($matches[1])){

                $arr['youtube'] = $matches[1];
            }

        }

        Movie::updateMovie($arr);
	}






}
