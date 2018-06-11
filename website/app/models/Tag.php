<?php


class Tag extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_tags';
    protected $fillable = ['category_id'];
    public $timestamps = false;

    public static function getCategoryTags($id, $lang)
    {
        return DB::table("category_tags")
            ->leftJoin("category_tags_lang", "category_tags.id", "=", "category_tags_lang.category_tags_id")
            ->where("category_tags.category_id", "=", $id)
            ->where("category_tags_lang.lang", "=", $lang)
            ->get();
    }

    public static function storeTag($category_id, $name, $image)
    {

        DB::transaction(function() use($category_id, $name, $image) {
            $id = self::create(array("category_id" => $category_id))->id;
            foreach( Cache::get("languages")  as $lang){
                $tag["category_tags_id"] = $id;
                $tag["name"] = $name;
                $tag["lang"] = $lang;
                if(trim($image)){
                    $tag["image"] = createImage($image);
                }

                DB::table("category_tags_lang")->insert($tag);
            }
        });
    }

    public static function getTag($id,$lang)
    {
        return DB::table("category_tags_lang")->where("category_tags_id" ,"=" ,$id)->where("lang" , "=" ,$lang)->first();
    }

    public static function updateTag($id)
    {
        DB::table("category_tags_lang")->where("id" , "=" ,$id)->update(Input::all());
    }

}
