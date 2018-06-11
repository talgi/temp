<?php


class Codes extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codes';
    public static $codesArray = array("Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M","1","2","3","4","5","6","6","7","8","9");
    public $timestamps = false;
    public static function storeCodes($bookletId,$codesSum)
    {
        $time = date('Y-m-d H:i:s',time());
        $oldCodes = self::where("booklets_id" , "=" , $bookletId)->get();
        $codes = array();
        $needOneMoreInsert = true;
        foreach($oldCodes as  $obj) {
            $oldCodes[$obj->code] = 1;
        }

        for($i = 0; $i < $codesSum; $i++) {
            $code = "";
            for($x = 0 ; $x < 8 ;$x++) {
                $code.= self::$codesArray[mt_rand(0,count(self::$codesArray)-1)];
            }
            if(isset($codes[$code]) || isset($oldCodes[$code])) {
               $i--;
            }
            else{
                $codes[$code] = array("code"=>$code,"booklets_id" =>$bookletId , "created_at" => $time);
            }
            if($i %  15000 == 0){
                $needOneMoreInsert = false;
                DB::table("codes")->insert($codes);
                $codes = array();
            }
            else{
                $needOneMoreInsert = true;
            }
        }
        if($needOneMoreInsert){
            DB::table("codes")->insert($codes);
        }


    }

    public static function getBookletList($id)
    {
            return DB::table("codes")->where("booklets_id" , "=" , $id)->groupBy("created_at")->get();
    }

    public static function addUserToCode($code,$userId)
    {
        $length = strlen($code);
        if( $length > 11 || $length < 10){
            return  false;
        }
        if($length == 10 ){

            $prefix =  substr($code , 0,2);
            $code = substr($code,2);
        }
        else{
            $prefix =  substr($code , 0,3);
            $code = substr($code,3);
        }
        $prefix = strtoupper($prefix);
        $code = strtoupper($code);
        $res = DB::table("booklets")
            ->join("booklets_lang" ,"booklets_lang.booklets_id" , "=" , "booklets.id")
            ->leftjoin("groups", "groups.id", "=", "booklets.group_id")
            ->leftjoin("category_tags_lang", "category_tags_lang.category_tags_id", "=", "booklets.tag_id")
            ->where("category_tags_lang.lang", "=", Config::get("app.locale"))
            ->where("prefix", "=", $prefix)
            ->select("booklets.id as id" , "booklets_lang.image1", 'prefix' , 'booklet_order' ,'points' ,'booklets.tag_id' ,'booklets.group_id' ,'reword' , 'page_number' , 'name' , 'image' , 'category_tags_id')
            ->first();
        if(!$res){
            return false;
        }
        $obj = self::where("code" , "=" , $code) ->where("booklets_id" , "=" ,$res->id)->first();

        if(!$obj || $obj->user_id ){
            return  false;
        }

        self::where("code" , "=" , $code)
            ->where("booklets_id" , "=" ,$res->id)
            ->update(array("user_id" => $userId));
        User::increaseScore($userId,$res->points);
        $res->finishCollaction = 0;
        if($res->group_id){
            $group = DB::table("groups")->where("id" , "=" , $res->group_id)->first();
            if($group){

                $userHasGroup = DB::table("user_groups")
                    ->where("group_id" , "=" , $res->group_id)
                    ->where("user_id" , "=" , $userId)
                    ->first();
                if($userHasGroup == null){
                    $bookletsIds = DB::table("codes")
                        ->select(DB::raw("distinct(booklets_id)"))
                        ->where("user_id" , "=" ,$userId)
                        ->get();

                    $groupBooklets = Booklet::where("group_id" , "=" , $res->group_id )->get();
                    $numberOfPageBooklets = 0;

                    foreach($bookletsIds as $objId){
                        foreach($groupBooklets as $objId2){
                            if($objId->booklets_id == $objId2->id){
                                $numberOfPageBooklets++;

                            }
                        }
                    }

                    if($numberOfPageBooklets == count($groupBooklets) - 1){
                        Mail::send('emails.missing1forpage', array(), function($message)
                        {
                            $message->to(Auth::user()->email)->subject('1 more booklet to finish a page');
                        });
                    }

                    $userBooklets = self::join("booklets" , "booklets.id" , "=" ,"codes.booklets_id")->where("user_id" , "=" , $userId)->get();
                    $count = 0 ;
                    $totalCounts = array();
                    $bookletsIds = array();
                    foreach($userBooklets as $obj){

                        if($obj->group_id == $res->group_id && !in_array($obj->booklets_id,$bookletsIds)){
                            $count++;
                            $bookletsIds[] = $obj->booklets_id;
                        }
                        $totalCounts[$obj->booklets_id] = 1;
                    }
                    $booklets =  DB::table("booklets")->where("group_id" , "=" ,  $res->group_id)->get();

                    if($count == count($booklets)){
                        User::increaseScore($userId,$group->reword);
                        $res->finishCollaction = 1;
                        $res->points+=$group->reword;
                        Db::table("user_groups")->insert(array("group_id" => $res->group_id ,"user_id" => $userId ));
                    }
                    if(Auth::user()->get_all_collaction_bonus == 0 && count($totalCounts) == count(DB::table("booklets")->where("group_id" , ">" , 0)->get())){
                        DB::table("users")->where("id" ,"=" ,$userId)->update(array("get_all_collaction_bonus" => 1));
                        User::increaseScore($userId,25000);
                        $res->points+=25000;
                        Notifications::create(array("user_id" => $userId , 'type' => "finish all" , "free_text"=>"Congagations! You proved you are a real WWE FLIPMADNESS champ! You have received 25,000 bonus points!" ,  "show_method" => "box"));
                    }
                }

            }
        }

        return $res;
    }

}
