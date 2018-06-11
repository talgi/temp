<?php

class BookletsController extends \BaseController
{


    public function getUserBooklets($id,$json = true)
    {
        $response = new stdClass();
        $response->success = 1;

        if(User::find($id) == null){
            $response->success = 0;

            $response->error = "Invalid user id";
            if($json){
                return Response::json($response);
            }
            return $response;
        }
        if($id != Auth::id()){
            User::increaseView($id);
        }
        $res = Booklet::getUserBooklets($id);

        $formattedRes = array();
        foreach ($res as $obj) {
            if (!isset($formattedRes[$obj->name])) {
                $formattedRes[$obj->name] = new stdClass();
                $formattedRes[$obj->name]->totalPages = 0;
                $formattedRes[$obj->name]->totalBooklets = 0;
                $formattedRes[$obj->name]->ownedBooklets = 0;
                $formattedRes[$obj->name]->pages = array();
            }
            $formattedRes[$obj->name]->totalBooklets++;

            if (!isset($formattedRes[$obj->name]->pages[$obj->page_number])) {
                $formattedRes[$obj->name]->pages[$obj->page_number] = new stdClass();
                $formattedRes[$obj->name]->pages[$obj->page_number]->booklets = array();
                $formattedRes[$obj->name]->pages[$obj->page_number]->reword = $obj->reword;
                $formattedRes[$obj->name]->pages[$obj->page_number]->counter = 0;
                $formattedRes[$obj->name]->totalPages++;
            }

            $booklet = new stdClass();
            $booklet->active = 0;

            if ($obj->number_of_booklets > 0) {
                $booklet->active = 1;
                if(isset($formattedRes[$obj->name]->pages[$obj->page_number]->counter)){
                    $formattedRes[$obj->name]->pages[$obj->page_number]->counter++;
                }
                else{
                    $formattedRes[$obj->name]->pages[$obj->page_number]->counter = 1;
                }

                $formattedRes[$obj->name]->ownedBooklets++;
            }
            $booklet->points = $obj->points;
            $booklet->imageActive = $obj->image;
            $booklet->title = $obj->title;
            $booklet->text = $obj->text;
            $booklet->id = $obj->booklet_id;
            $booklet->total_books = $obj->number_of_booklets;
            $formattedRes[$obj->name]->pages[$obj->page_number]->booklets[] =$booklet;
        }
        $response->totalBooklets = 0;
        $response->ownedBooklets = 0;

        foreach($formattedRes as $name => &$obj){
            ksort($obj->pages);
            foreach($obj->pages as &$obj2){
                if(count($obj2->booklets) == $obj2->counter ){
                    $obj2->cliamed_reword = 1;
                }
                else{
                    $obj2->cliamed_reword = 0;
                }
                unset($obj2->counter);

            }
            $response->totalBooklets+=$obj->totalBooklets;
            $response->ownedBooklets+=$obj->ownedBooklets;


        }
        $response->collaction = $formattedRes;
        if($json){
            return Response::json($response);
        }

        return $response;
    }

}
