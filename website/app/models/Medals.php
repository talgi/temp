<?php


class Medals extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medals';
    protected $fillable = ['text','views','lang' ,"reword" , "notification_text"];
    public $timestamps = false;


    public static function getMedals()
    {
        return self::where("lang" ,"=",Config::get("app.locale"))->orderBy("reword")->get();
    }


}
