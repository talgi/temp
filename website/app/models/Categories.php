<?php


class Categories extends Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    public $timestamps = false;

    public static function getCategoriesByLang($lang)
    {

        return  DB::table("category_lang")->where("lang" , "=" ,$lang)->get();
    }

    public static function getCategory($id,$lang)
    {
        return  DB::table("category_lang")
                ->where("lang" , "=" ,$lang)
                ->where("category_id" , "=" ,$id)
                ->first();
    }

    public static function storeCategory()
    {
        DB::transaction(function(){
            $id = self::create(array())->id;
            foreach( Cache::get("languages")  as $lang){
                $cat = array();
                foreach(Input::all() as $key => $val)
                {
                    if($key != "name" && $val){
                        $cat[$key] = createImage($val);
                    }
                    else{
                        $cat[$key] = $val;
                    }
                }
                $cat['lang'] =$lang;
                $cat['category_id'] = $id;
                DB::table("category_lang")->insert($cat);
            }
        });


    }

    public static function updateCategory($id)
    {
        $update = array();
        foreach(Input::all() as $key => $val)
        {
            if(($key == "banner" || $key =="logo") && trim($val)){
                $update[$key] = createImage($val);;
            }
            elseif(trim($val)){
                $update[$key] = $val;
            }

        }

        DB::table("category_lang")
            ->where("lang" , "=" ,Input::get("lang"))
            ->where("category_id" , "=" ,$id)
            ->update($update);

        print_r($update);
        echo $id;
        echo Input::get("lang");
    }

}
