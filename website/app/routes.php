<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//if(App::isLocal()) {
    header('Access-Control-Allow-Origin: http://localhost:9000 ');
    header('Access-Control-Allow-Credentials: true ');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE ');

//}


Route::group(array("prefix" => CMS_NAME, "before" => "admin"), function () {


    Route::resource("categories", "AdminCategoryController");
    Route::resource("tags", "AdminTagController");
    Route::resource("booklets", "AdminBookletController");
    Route::resource("movie","AdminMovieController");
    Route::resource("home-prizes", "AdminHomePrizesController");
    Route::resource("lotteries-cat", "AdminLotteriesCatController");
    Route::resource("lotteries", "AdminLotteriesController");
    Route::resource("medals","AdminMedalsController");
    Route::resource("inner","AdminInnerPagesController");
    Route::resource("site-text", "AdminTextController");
    Route::resource("groups", "AdminGroupsController");
    Route::resource("notifications", "AdminNotificationsController");
    Route::controller("mange-users", "AdminMangeUsersController");
    Route::get("winners",function(){
        $winners = Lotteries::getAdminWinners();
        array_unshift($winners,array("lottery_id" , "end_date" , "prizes" , "user_id" , "first_name", "last_name" , "email" , "postal" , "address" , "city"  ,"phone"));
        download_send_headers("winners.csv");

        echo array2csv($winners);
        die();
    });

    Route::get("downloadCsv/{id}/{date}",function($id , $date){
        $booklet = Booklet::getBooklet($id,Config::get("app.locale"));

        $codes = Codes::where("created_at" , "=" , urldecode($date))->where("booklets_id", "=", $id )->get();
        $arr = array();
        foreach($codes as $obj)
        {
            array_push($arr , array($booklet->prefix.$obj->code));
        }

        download_send_headers($booklet->title."_".$codes[0]->created_at.".csv");

        echo array2csv($arr);
        die();
    });

    //   Route::controller("tag", "CategoryController");
    Route::controller("/", "AdminController");



});

Route::group(array("before" => "auth"), function () {

    Route::resource("codes", "CodesController");
    Route::controller("my-flip-madness", "UserController");

});

Route::resource("home","HomeController");
Route::controller("auth","AuthController");
Route::controller("general","GeneralController");
Route::controller("booklet", "BookletsController");

Route::controller("cli", "CliController");
Route::get("test",function(){

    $lists = MailchimpWrapper::lists()->getList()['data'];
    print_r($lists);
});
