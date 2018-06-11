<?php


class Notifications extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';
    protected $fillable = ['user_id','type','other_table_id',"free_text" , "free_number" , "show_method"];
    public $timestamps = true;


    /**
     * notifications types
     * medal
     * lottery losser
     * lottery winner
     * new friend
     * views
     */
    public static function getNotifications($userId)
    {
       $res =  self::where("user_id" , "=" ,$userId)
            ->select("free_text" , "show_method" , "type" , "free_number" , "other_table_id" , "id")
            ->get();

        foreach($res as $key => &$obj){
            if($obj->other_table_id){
                switch ($obj->type){
                    case "challenge achieved":
                        $obj->details = Lotteries::getAchivmentLottery($obj->other_table_id);
                        $obj->id = $obj->id;
                        break;
                    case "medal":
                        $obj->medal = Medals::where("id" , "=" ,$obj->other_table_id);
                        break;
                    case "lottery losser":
                        $obj->details = Lotteries::getFullLottery($obj->other_table_id);
                        $obj->id = $obj->id;
                        break;
                    case "lottery winner":
                        $obj->details = Lotteries::getFullLottery($obj->other_table_id);
                        $obj->id = $obj->id;
                        break;
                }
            }
            unset($obj->other_table_id);
        }

        return $res;
    }

    public static function deleteNotifications($id)
    {
        /*
        if(App::isLocal()){
            return;
        }
        */
        $sql = self::where("user_id" , "=" ,Auth::id());
        if($id){
            $sql->where("id" , "=" , $id);
        }
        $sql->delete();
    }
}
