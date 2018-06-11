<?php


class UserMedals extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_medals';
    protected $fillable = ['user_id','medal_id'];
    public $timestamps = false;


    public static function getUserMedals()
    {

        $res = DB::table("medals")
            ->select("medals.text" , "medals.views" , "medals.reword" , "user_medals.user_id as active" )
            ->leftJoin("user_medals", function ($join) {
                $join->on("user_medals.medal_id", "=", "medals.id")
                    ->where("user_medals.user_id", "=", Auth::id());
            })
            ->where("medals.lang" , "=" , Config::get("app.locale"))
            ->get();
        return $res;
        /*
        foreach ($res as $key => &$obj) {
            $obj->width = Auth::user()->view >= $obj->views ?"100%" : (Auth::user()->view / $obj->views * 100)."%";
        }
        */


    }

}
