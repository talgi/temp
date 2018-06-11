<?php

class UserController extends \BaseController {

	public function getAllPage()
    {
        $response = new stdClass();
        $response->success = 1;
        $response->barAchivments = array();
        $response->friends = 0;
        $res  = Lotteries::getCats(Config::get("app.locale"));

        foreach($res as $key => $obj) {
            $response->barAchivments[$key] = new stdClass();
            $response->barAchivments[$key]->required_points = $obj->required_points;
            $response->barAchivments[$key]->percent = $obj->required_points/40000*100;
            $response->barAchivments[$key]->image = $obj->image;
            $response->barAchivments[$key]->text = $obj->text;
        }
        $bookletsController = new BookletsController();
        $response->collaction = $bookletsController->getUserBooklets(Auth::id(),false);
        $response->medals = UserMedals::getUserMedals();
        $response->topPlayers = User::getTopRanked();
        $response->topFriends = User::getTopFriendsRanked( Auth::id());
        $response->nextLottery = Lotteries::getUserNextLottery( Auth::id());
        $response->userLotteris = array();
        $response->closestLottery = new stdClass();
        $response->closestLottery->end = 0;
        foreach( Lotteries::get4ClosetsLotteries() as $obj){

            if (isset($obj->lottery) && ($obj->lottery->end < $response->closestLottery->end || $response->closestLottery->end == 0))  {
                $response->closestLottery->end = $obj->lottery->end;
            }

            if(Auth::user()->score >= $obj->required_points){
                $response->userLotteris[] = $obj;
            }
        }


        return Response::json($response);
    }

    public function getIncreaseScore()
    {
        $response = new stdClass();
        $response->success = 1;
        $response->friends = 0;
        $response->topPlayers = User::getTopRanked();
        $response->topFriends = User::getTopFriendsRanked( Auth::id());
        $response->userLotteris = array();
        $response->closestLottery = new stdClass();
        $response->closestLottery->end = 0;
        foreach( Lotteries::get4ClosetsLotteries() as $obj){

            if (isset($obj->lottery) && ($obj->lottery->end < $response->closestLottery->end || $response->closestLottery->end == 0))  {
                $response->closestLottery->end = $obj->lottery->end;
            }

            if(Auth::user()->score >= $obj->required_points){
                $response->userLotteris[] = $obj;
            }
        }
        $response->nextLottery = Lotteries::getUserNextLottery( Auth::id());
        return Response::json($response);

    }

    public function getNotifications()
    {
        return Response::json(Notifications::getNotifications(Auth::id()));
    }

    public function getDeleteNotifications($id = false)
    {

        Notifications::deleteNotifications($id);
    }


    public function postSettings()
    {
        $messages = array(
            'is_user_password' => 'The :attribute field does not match your password.',
        );

        $validator = Validator::make(Input::all(), User::updateRules(),$messages);
        $response =  new stdClass();
        $response->success = 0;
        if ($validator->passes()) {
            $data = Input::all();
            unset($data['verify_password']);
            $data['birthday'] = date('Y-m-d H:i:s', strtotime($data['birthday']));

            if($data['password']) {
                $data['password'] = Hash::make(Input::get('password'));
            }
            if(!$data['email']){
                unset($data['email']);
            }
            if($data['user_image']){

                $imageName = createImage( $data['user_image']);
                $image = \Imagecow\Image::create(file_get_contents(PATH_UPLOAD.$imageName));

                $image->resizeCrop(300, 300);
                $image->save(PATH_UPLOAD.$imageName);
                $data['image'] = $imageName;
            }
            $data['fill_lot_details']  = 1;
            $response->success = 1;
            unset($data['user_image']);
            User::updateUser($data);
            return Response::json($response);

        }
        else{
            $response->error = $validator->messages()->all();

            return Response::json($response);
        }
    }

    public function postJoinLottery()
    {


        $validator = Validator::make(Input::all(), User::joinRules());
        $response =  new stdClass();
        $response->success = 0;
        if ($validator->passes()) {
            $data = Input::all();
            if(Input::get("terms")){
                $data['accept_email'] =  1;
                unset($data['terms']);
            }
            $data['fill_lot_details']  = 1;
            $response->success = 1;
            User::updateUser($data);
            $response->msg = "You have successfully register to all future draws for your earned  achievements. once you will get a new  achievement you will automatically joined her draws";
            return Response::json($response);

        }
        else{
            $response->msg = $validator->messages()->all();

            return Response::json($response);
        }
    }

    public function getSettings()
    {
        return Response::json(User::getSettings());
    }

    public function getUpcomingLotteries()
    {
        $response = new stdClass();
        $response->upcoming = Lotteries::get4ClosetsLotteries();
        $response->all = Lotteries::getUpComingLotteries();
        if(Auth::id()){
            $userLottry = Lotteries::getUserLotteriesIds(Auth::id());
            foreach($response->all as $key => &$obj){
                foreach($userLottry as $obj2){
                    if($obj2 && $obj->id == $obj2->id)
                    {
                        $obj->selected = 1;
                       break;

                    }
                    else{
                        $obj->selected = 0;
                    }

                }
            }
        }

        return Response::json($response);
    }

    public function getLotteryWinners()
    {
        return Response::json(Lotteries::getLotteryWinners());
    }





}
