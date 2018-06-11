<?php


class Booklet extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booklets';
    protected $fillable = ['category_id'];
    public $timestamps = false;
    public static function getTagBooklets($id, $lang)
    {
        return DB::table("booklets")
            ->leftJoin("booklets_lang", "booklets.id", "=", "booklets_lang.booklets_id")
            ->where("booklets.tag_id", "=", $id)
            ->where("booklets_lang.lang", "=", $lang)
            ->get();
    }

    public static function notifyBeforeFinishPage()
    {

    }

    public static function storeBooklet($tag_id,$obj)
    {

        DB::transaction(function() use($tag_id,$obj) {

            $id = DB::table("booklets")->insertGetId(array("tag_id" => $tag_id , "points" => $obj->points , "prefix" => $obj->prefix));

            foreach( Cache::get("languages")  as $lang){
                $booklet = array();
                $booklet["booklets_id"] = $id;
                $booklet["text1"] = Input::get("text1");
                $booklet["text2"] = Input::get("text2");
                $booklet["title"] = $obj->title;
                $booklet["lang"] = $lang;
                if(trim(Input::get("image1"))){
                    $booklet["image1"] = createImage(Input::get("image1"));
                }
                if(trim(Input::get("image2"))){
                    $booklet["image2"] = createImage(Input::get("image2"));
                }
                if(trim(Input::get("image3"))){
                    $booklet["image3"] = createImage(Input::get("image3"));
                }

                DB::table("booklets_lang")->insert($booklet);

                if(is_numeric($obj->copies)){
                     Codes::storeCodes($id,$obj->copies);
                }
            }
        });
    }

    public static function getBooklet($id,$lang)
    {
        return DB::table("booklets")
            ->join("booklets_lang" , "booklets_lang.booklets_id" ,"=" ,"booklets.id")
            ->where("booklets_lang.lang" ,"=" ,$lang)
            ->where("booklets.id" ,"=" ,$id)->first();
    }

    public static function updateTag($id)
    {
        DB::table("category_tags_lang")->where("id" , "=" ,$id)->update(Input::all());
    }

    public static function getUserBooklets($userId)
    {
        return  DB::table("booklets")
            ->join("booklets_lang" , "booklets_lang.booklets_id" , "=" , "booklets.id" )
            ->leftJoin("category_tags_lang" ,"category_tags_lang.category_tags_id" , "=" , "tag_id")
            ->join("groups" , "groups.id" , "=" , "booklets.group_id")
            ->leftJoin(DB::raw("(select count(booklets_id) as number_of_booklets , booklets_id , user_id from codes where user_id = $userId group by(booklets_id)) as d "), function($join) use($userId)
            {

                $join->on('d.booklets_id', '=', 'booklets.id');

            })
            ->select(
                "category_tags_lang.name as name"  ,
                "booklets.id as booklet_id" ,
                "d.number_of_booklets",
                "booklets.points as points",
                "booklets_lang.image1 as image",
                "booklets_lang.image2 as imageActive",
                "booklets_lang.title as title",
                "booklets_lang.text1 as text",
                "groups.page_number as page_number",
                "groups.reword as reword"

            )


            ->get();

    }

    public static function updateBooklet($arr,$id){


        foreach($arr as $key => $val)
        {
            if(($key == "image1" || $key == "image2" || $key == "image3")   && $val ){
                $arr[$key] = createImage($val);
            }
            else if($key == "image1" || $key == "image2" || $key == "image3"){
                unset($arr[$key]);
            }
        }
        if(count($arr) == 1) {

            self::where("id", "=", $id)->update($arr);
        }
        else{
            $arr2 = array("points" => $arr['points']  );
            unset( $arr['points']);

            self::where("id", "=", $id)->update($arr2);
            DB::table("booklets_lang")
                ->where("booklets_id" , "=" , $id)
                ->where("lang" , "=" ,Config::get("app.locale"))
                ->update($arr);
        }
    }



}
