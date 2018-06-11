<?php


class Movie extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'movie';
    public $timestamps = false;


    public static function getMovie()
    {
        return self::where("lang" ,"=",Config::get("app.locale"))->first();
    }

    public static function updateMovie($arr)
    {
        self::where("lang" ,"=",Config::get("app.locale"))->update($arr);
    }
}
