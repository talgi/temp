<?php


class HomePrizes extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'home_prizes';
    protected $fillable = ['text','image','lang'];
    public $timestamps = false;


    public static function getPrizes()
    {
        return self::where("lang" ,"=",Config::get("app.locale"))->get();
    }


}
