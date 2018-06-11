<?php


class Groups extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';
    protected $fillable = ['tag_id',"reword","page_number"];
    public $timestamps = false;


    public static function updateGroup($arr,$id){
        $check = self::where("page_number" , "=" ,$arr['page_number'] )
            ->where("tag_id","=",$arr['tag_id'])
            ->where("id" , "!=" ,$id)
            ->first();
         if($check){
             return false;
         }

        self::where("id" ,"=" ,$id)->update($arr);
        return true;
    }

    public static function createGroup($arr)
    {
        $check = self::where("page_number" , "=" ,$arr['page_number'] )
            ->where("tag_id","=",$arr['tag_id'])
            ->first();
        if($check){
            return false;
        }


        return self::create(Input::all());
    }

}
