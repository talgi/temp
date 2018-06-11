<?php


class Lotteries extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;


    public static function get4ClosetsLotteries()
    {
        $cats = DB::table("lotteries_cat")
            ->join("lotteries_cat_lang" ,"lotteries_cat_lang.lotteries_cat_id" ,"=" , "lotteries_cat.id")
            ->where("lotteries_cat_lang.lang" ,"=", Config::get("app.locale"))
            ->orderBy("lotteries_cat.required_points" )
            ->get();


        foreach($cats as &$obj){
            $obj->lottery = DB::table("lotteries")
                ->where("lotteries_cat_id" ,"=" ,$obj->lotteries_cat_id)
                ->where("lotteries.end", ">", DB::raw("FROM_UNIXTIME(" . time() . ")"))
                ->orderBy("end")
                ->first();
            if($obj->lottery){
                $obj->lottery->end = strtotime($obj->lottery->end);
                $obj->lottery->end_date = Date("M. d, Y" , $obj->lottery->end );
            }
        }

        reset($cats);
        return $cats;
    }

    public static function getAchivmentLottery($id)
    {
        $cat = DB::table("lotteries_cat")
            ->join("lotteries_cat_lang" ,"lotteries_cat_lang.lotteries_cat_id" ,"=" , "lotteries_cat.id")
            ->where("lotteries_cat_lang.lang" ,"=", Config::get("app.locale"))
            ->where("lotteries_cat.id" , "=" ,$id)
            ->orderBy("lotteries_cat.required_points" , "desc")
            ->first();



        $cat->lottery = DB::table("lotteries")
                ->where("lotteries_cat_id" ,"=" ,$cat->lotteries_cat_id)
                ->where("lotteries.end", ">", DB::raw("FROM_UNIXTIME(" . time() . ")"))
                ->orderBy("end")
                ->first();
            if($cat->lottery){
                $cat->lottery->end = strtotime($cat->lottery->end);
                $cat->lottery->end_date = Date("M d Y" , $cat->lottery->end );
            }



        return $cat;
    }

    public static function updateWinners()
    {
        $res = DB::table("lotteries")
            ->join("lotteries_cat" , "lotteries_cat.id" , "=" , "lotteries.lotteries_cat_id")
            ->where("lotteries.end" , "<=" ,DB::raw("FROM_UNIXTIME(".time().")") )
            ->where("lotteries.finish_prizes_action" , "=" ,0 )
            ->select("lotteries.id as id" , "lotteries.finish_prizes_action" , "lotteries.lotteries_cat_id" , "lotteries_cat.number_of_winners")
            ->get();
        foreach($res as $index => $obj){
            $res2 = DB::table("lotteries_users")
                ->where("lotteries_cat_id" , "=" , $obj->lotteries_cat_id)
                ->get();
            $length =  count($res2);
            if($length){
                $usersIds = array();
                $winnersNotifications = array();
                $winnersTable = array();
                for($i = 0; ($i < $length && $i < $obj->number_of_winners) ; $i++){
                    $key = mt_rand(0,($length-1));
                    $usersIds[] =  array("user_id" => $res2[$key]->user_id , "lotteries_id"=> $obj->id);
                    $winnersNotifications[] = array("user_id" => $res2[$key]->user_id, "other_table_id"=>$obj->id , 'type' => "lottery winner" ,"show_method" => "popup" );
                    $winnersTable[] = array("user_id" => $res2[$key]->user_id, "lotteries_id"=>$obj->id  );
                    unset($res2[$key]);
                }

                if (DB::table("lotteries")->where("id", "=", $obj->id)->first()->finish_prizes_action == 0) {
                    DB::table("lotteries_winners")->insert($winnersTable);
                    Notifications::insert($winnersNotifications);
                }
                $lossersNotifications = array();
                if(!empty($res2)){
                    foreach($res2 as $obj2){
                        $lossersNotifications[] = array("user_id" => $obj2->user_id, "other_table_id"=>$obj->id , 'type' => "lottery losser" ,"show_method" => "popup" );
                    }
                    if (DB::table("lotteries")->where("id", "=", $obj->id)->first()->finish_prizes_action == 0) {
                        Notifications::insert($lossersNotifications);
                    }

                }
            }
            if (DB::table("lotteries")->where("id", "=", $obj->id)->first()->finish_prizes_action == 0) {
                DB::table("lotteries")->where("id", "=", $obj->id)->update(array("finish_prizes_action" => 1));
            }

        }

    }
    public static function getAdminWinners(){

        DB::setFetchMode(PDO::FETCH_ASSOC);
        $res = DB::table("lotteries")
            ->join("lotteries_cat" , "lotteries_cat.id" , "=" , "lotteries.lotteries_cat_id")
            ->join("lotteries_cat_lang" , "lotteries_cat.id" , "=" , "lotteries_cat_lang.lotteries_cat_id")
            ->leftJoin("lotteries_winners" , "lotteries_winners.lotteries_id" , "=" ,"lotteries.id")
            ->leftJoin("users" , "users.id" , "=" ,"lotteries_winners.user_id")
            ->where("lotteries.end" , "<=" ,DB::raw("FROM_UNIXTIME(".time().")") )
            ->where("lotteries.finish_prizes_action" ,"=" , 1)
            ->select("lotteries.id as lottery_id" ,
                DB::raw("DATE_FORMAT(lotteries.end,'%b %d %Y') as end_date") ,
                "lotteries_cat_lang.text as prizes",
                "users.id as user_id ",
                "users.first_name as first_name" ,
                "users.last_name as last_name" ,
                "users.email" ,
                "users.postal",
                "users.address",
                "users.city",
                "users.phone"
               )
            ->orderBy("lottery_id")
            ->get();
        return $res;

    }
    public static function getLotteryWinners()
    {


        $res = DB::table("lotteries")
            ->join("lotteries_cat" , "lotteries_cat.id" , "=" , "lotteries.lotteries_cat_id")
            ->join("lotteries_cat_lang" , "lotteries_cat.id" , "=" , "lotteries_cat_lang.lotteries_cat_id")
            ->leftJoin("lotteries_winners" , "lotteries_winners.lotteries_id" , "=" ,"lotteries.id")
            ->leftJoin("users" , "users.id" , "=" ,"lotteries_winners.user_id")
            ->where("lotteries.end" , "<=" ,DB::raw("FROM_UNIXTIME(".time().")") )
            ->where("lotteries.finish_prizes_action" ,"=" , 1)
            ->select("lotteries_cat.image as lot_image" ,
                DB::raw("DATE_FORMAT(lotteries.end,'%b %d %Y') as end_date") ,
                DB::raw("UNIX_TIMESTAMP(lotteries.end) as end_date_unix") ,
                "users.id as user_id ",
                "users.image as user_image" ,
                "users.first_name as first_name" ,
                "users.last_name as last_name" ,
                "lotteries_cat_lang.text as prizes",
                "lotteries.id as lottery_id")
            ->orderBy("lottery_id")
            ->get();
        $formatedResults = array();
        foreach($res as $obj){
            $key  = $obj->end_date_unix+$obj->lottery_id;
            if(!isset($formatedResults[$key])){
                $formatedResults[$key] = $obj;
                $formatedResults[$key]->users = array();
                $lot_user = new stdClass();
                $lot_user->name = $obj->first_name." ".$obj->last_name;
                $lot_user->image = $obj->user_image ? $obj->user_image  : "no-user-image-square.jpg";
                $lot_user->user_id = $obj->user_id;

                $formatedResults[$key]->users[$obj->user_id] = $lot_user;

                if(!$obj->user_id){
                    unset($formatedResults[$key]);
                }
            }else{
                $lot_user = new stdClass();
                $lot_user->name = $obj->first_name." ".$obj->last_name;
                $lot_user->image = $obj->user_image ? $obj->user_image  : "no-user-image-square.jpg";
                $lot_user->user_id = $obj->user_id;

                $formatedResults[$key]->users[$obj->user_id] = $lot_user;
            }

        }
        ksort($formatedResults);

        return $formatedResults;
    }


    public static function getUpComingLotteries()
    {
        $obj =  DB::table("lotteries")
            ->select("lotteries_lang.name" , DB::raw("DATE_FORMAT(end,'%b. %d, %Y') as end_date" ), "lotteries.id")
            ->join("lotteries_lang" , "lotteries_lang.lotteries_id" , "=" , "lotteries.id")
            ->where("lotteries.end" , ">" ,DB::raw("FROM_UNIXTIME(".time().")") )
            ->where("lotteries_lang.lang" , "=" ,Config::get("app.locale") )
            ->orderBy("end")
            ->get();


        return $obj;
    }
    public static function updateMovie($arr)
    {
        self::where("lang" ,"=",Config::get("app.locale"))->update($arr);
    }

    public static function getCat($id,$lang){
        return DB::table("lotteries_cat")
            ->join("lotteries_cat_lang" , "lotteries_cat_lang.lotteries_cat_id" , "=" , "lotteries_cat.id")
            ->where("lotteries_cat.id" , "=" , $id)
            ->where("lotteries_cat_lang.lang" , "=" , $lang )
            ->first();
    }

    public static function getCats($lang){
        return DB::table("lotteries_cat")
            ->join("lotteries_cat_lang" , "lotteries_cat_lang.lotteries_cat_id" , "=" , "lotteries_cat.id")
            ->where("lotteries_cat_lang.lang" , "=" , $lang )
            ->get();
    }

    public static function getCatLotteries($catId)
    {
        $res =  DB::table("lotteries")
            ->join("lotteries_lang" , "lotteries_lang.lotteries_id" , "=" , "lotteries.id")
            ->where("lotteries_lang.lang" , "=" , Config::get("app.locale") )
            ->where("lotteries.lotteries_cat_id" , "=" , $catId)
            ->get();

        foreach($res as &$obj){
            $obj->start = date('d-m-Y ', strtotime($obj->start));
            $obj->end = date('d-m-Y ', strtotime($obj->end));
        }

        return $res;
    }


    public static function createCat($arr)
    {
        $arr2 = array("name" => $arr['name'], "text" => $arr['text'],);
        unset($arr['name']);
        unset($arr['text']);
        if(!empty($arr['image'])){
            $arr["image"] = createImage($arr['image']);

        }
        $arr2['lotteries_cat_id'] = DB::table("lotteries_cat")->insertGetId($arr);
        $arr2['lang'] = Config::get("app.locale");
        DB::table("lotteries_cat_lang")->insert($arr2);
        return self::getCat($arr2['lotteries_cat_id'] , Config::get("app.locale") );
    }

    public static function updateCat($arr, $id)
    {
        $arr2 = array("name" => $arr['name'], "text" => $arr['text']);
        unset($arr['name']);
        unset($arr['text']);
        if(!empty($arr['image'])){
            $arr["image"] = createImage($arr['image']);
        }
        else {
            unset($arr['image']);
        }
        DB::table("lotteries_cat")->where("id" , "=" , $id)->update($arr);
        DB::table("lotteries_cat_lang")->where("lotteries_cat_id" , "=" , $id)->where("lang" , "=" , Config::get("app.locale"))->update($arr2);

    }


    public static function createLottery($arr)
    {
        $arr2 = array("name" => $arr['name'] , "lang" => Config::get("app.locale") );
        unset($arr['name']);
        $arr2['lotteries_id'] = DB::table("lotteries")->insertGetId($arr);
        DB::table("lotteries_lang")->insert($arr2);
        foreach(User::get() as $key => $obj){
            self::enterUserToLotteryCat($obj->id);
        }
        return self::getLottery($arr2['lotteries_id']);
    }

    public static function updateLottery($arr,$id)
    {
        $arr2 = array("name" => $arr['name'] );
        unset($arr['name']);
        $arr['start'] = date('Y-m-d ', strtotime($arr['start']));
        $arr['end'] = date('Y-m-d H:i:s', strtotime($arr['end'])+64800);
        DB::table("lotteries")->where("id" , "=" , $id)->update($arr);

        DB::table("lotteries_lang")
            ->where("lang" , "=" , Config::get("app.locale") )
            ->where("lotteries_id", "=", $id)
            ->update($arr2);
    }


    public static function getLottery($id)
    {
        $obj =  DB::table("lotteries")
            ->join("lotteries_lang" , "lotteries_lang.lotteries_id" , "=" , "lotteries.id")
            ->where("lotteries.id" , "=" , $id)
            ->where("lotteries_lang.lang" , "=" , Config::get("app.locale"))
            ->first();
        $obj->start = date('d-m-Y ', strtotime($obj->start));
        $obj->end = date('d-m-Y ', strtotime($obj->end));

        return $obj;
    }

    public static function getFullLottery($id)
    {
        $obj =  DB::table("lotteries")
            ->join("lotteries_lang" , "lotteries_lang.lotteries_id" , "=" , "lotteries.id")
            ->join("lotteries_cat" , "lotteries.lotteries_cat_id" , "=" , "lotteries_cat.id")
            ->join("lotteries_cat_lang" , "lotteries_cat_lang.lotteries_cat_id" , "=" , "lotteries_cat.id")
            ->where("lotteries.id" , "=" , $id)
            ->where("lotteries_lang.lang" , "=" , Config::get("app.locale"))
            ->select("lotteries_cat_lang.text as prizes" , "lotteries_cat.image" , DB::raw("DATE_FORMAT(end,'%b %d %Y') as end_date") )
            ->first();

        return $obj;
    }


    public static function deleteLottery($id)
    {
        DB::table("lotteries")->where("id" , "=" , $id)->delete();
        DB::table("lotteries_lang")->where("lotteries_id" , "=" , $id)->delete();
    }

    public static function getUserLotteries($userId)
    {
        $res =  DB::table("lotteries_cat")
            ->join("lotteries_cat_lang", "lotteries_cat_lang.lotteries_cat_id", "=", "lotteries_cat.id")
            ->leftjoin("lotteries_users" , "lotteries_users.lotteries_cat_id", "=", "lotteries_cat.id")
            ->leftjoin("lotteries_waiting_list" , "lotteries_waiting_list.lotteries_cat_id", "=", "lotteries_cat.id")
            ->where("lotteries_users.user_id", "=", $userId)
            ->orWhere("lotteries_waiting_list.user_id" , "=" ,$userId)
            ->orderBy("lotteries_cat.required_points" , "DESC")
            ->get();
        //lastQurey();
        return $res;
    }
    public static function getUserLotteriesIds($userId)
    {
        return DB::table("lotteries")
            ->select("lotteries.id")
            ->join("lotteries_cat" , "lotteries_cat.id" , "=" ,"lotteries.lotteries_cat_id")
            ->leftJoin("lotteries_users" , "lotteries_users.lotteries_cat_id", "=", "lotteries_cat.id")
            ->where("lotteries_users.user_id", "=", $userId)
            ->get();
    }
    public static function getUserNextLottery($userId)
    {
        $userLotteries = self::getUserLotteries($userId);

        if(count($userLotteries) > 0 ){
            $obj = DB::table("lotteries_cat")
                ->join("lotteries_cat_lang", "lotteries_cat_lang.lotteries_cat_id", "=", "lotteries_cat.id")
                ->where("lotteries_cat.required_points", ">",  $userLotteries[0]->required_points)
                ->orderBy("lotteries_cat.required_points" ,"asc")
                ->first();
        }

        else {
            $obj = DB::table("lotteries_cat")
                ->join("lotteries_cat_lang", "lotteries_cat_lang.lotteries_cat_id", "=", "lotteries_cat.id")
                ->orderBy(".lotteries_cat.required_points" ,"asc")
                ->first();
        }
        if (!empty($obj)) {
            $obj->lottery = DB::table("lotteries")
                ->select(DB::raw("DATE_FORMAT(end,'%b %d %Y') as end_date") , "end")
                ->where("lotteries_cat_id", "=", $obj->lotteries_cat_id)
                ->where("lotteries.end" , ">" ,DB::raw("FROM_UNIXTIME(".time().")") )
                ->orderBy("end")
                ->first();
            if ($obj->lottery) {
                $obj->lottery->end = strtotime($obj->lottery->end);
                $obj->lottery->end_date = Date("M d Y" , $obj->lottery->end );
            }
        }
        else{
            $obj = null;
        }
        return $obj;

    }

    public static function enterUserToLotteryCat($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $cats = self::getCats(Config::get("app.locale"));
            $catsIds = array();
            foreach ($cats as $cat) {
                if ($user->score >= $cat->required_points)
                {
                    $catsIds[$cat->id] = $cat->id;
                }
                elseif($user->score >= $cat->required_points * 0.8){
                    Notifications::create(array("user_id" => $userId, "free_text"=>"You are missing only ".($cat->required_points - $user->score)." points to earn your next achievement" , 'type' => "close to achivment", "show_method" => "box"));

                }
            }

            $cats = DB::table("lotteries_users")->where("user_id" , "=" , $userId)->get();
            foreach ($cats as $cat) {
                if (isset($catsIds[$cat->lotteries_cat_id] ))
                {
                   unset($catsIds[$cat->lotteries_cat_id]);
                }
            }

            if(count($catsIds) > 0 ){
                $cats = DB::table("lotteries_waiting_list")->where("user_id" , "=" , $userId)->get();
                foreach ($cats as $cat) {

                    if (isset($catsIds[$cat->lotteries_cat_id] ))
                    {
                        if($user->fill_lot_details){
                            DB::table("lotteries_users")->insert(array("user_id" => $userId , "lotteries_cat_id" =>  $cat->lotteries_cat_id));
                            DB::table("lotteries_waiting_list")->where("user_id" , "=" ,$userId)->where("lotteries_cat_id" ,"=" ,$cat->lotteries_cat_id)->delete();
                        }
                        unset($catsIds[$cat->lotteries_cat_id]);
                    }
                }
            }

            if($user->fill_lot_details){
                if(count($catsIds) > 0 ){
                    $arr = array();
                    foreach ($catsIds as $val) {
                        $arr[] = array("user_id" => $userId, "lotteries_cat_id" => $val);
                        Notifications::create(array("user_id" => $userId, "other_table_id"=>$val , 'type' => "challenge achieved", "show_method" => "popup"));
                    }
                    if(count($arr) > 0) {
                        DB::table("lotteries_users")->insert($arr);
                    }

                }
            }
            else{
                $arr = array();
                foreach ($catsIds as $val) {
                    $arr[] = array("user_id" => $userId, "lotteries_cat_id" => $val);
                    Notifications::create(array("user_id" => $userId, "other_table_id"=>$val , 'type' => "challenge achieved", "show_method" => "popup"));

                }
                if(count($arr) > 0) {
                    DB::table("lotteries_waiting_list")->insert($arr);
                }
            }
        }
    }
}
