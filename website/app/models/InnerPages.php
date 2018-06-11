<?php


class InnerPages extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inner_pages';
    protected $fillable = ['content',"page_name"];
    public $timestamps = false;


    public static function getPage($name)
    {
            return self::where("page_name" , "=" , $name)->first();
    }

    public static function setPage($name, $data)
    {
        self::where("page_name" , "=" , $name)->update($data);
    }


}
