<?php

class HomeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $json = new stdClass();
        $json->prizes = HomePrizes::getPrizes();
        $json->movie = Movie::getMovie();
        $json->topPlayers = User::getTopRanked();
        $json->nextLotteries = Lotteries::get4ClosetsLotteries();
        $json->upcomingLotteries = Lotteries::getUpComingLotteries();
        $json->server_time = time();
        return Response::json($json);

	}



}
