<?php
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;


class AdminTagController extends Controller {


    public function __construct(){
        Assets::add(url()."/public/js/tai/taipages/categories.js");
    }




    public function store()
    {

        Tag::storeTag(Input::get("category_id"),Input::get("name"),Input::get("image"));
        return View::make("admin.components.tags",array("tags" =>Tag::getCategoryTags(Input::get("category_id"),Config::get("app.locale"))))->render();

    }

    public function show($id)
    {

        $this->data['tag'] = Tag::getTag($id,Config::get("app.locale"));
        $this->data['groups'] = Groups::where("tag_id" ,"=" ,$id)->get();
        $this->data['booklets'] =  View::make("admin.components.booklet",array("booklets" =>Booklet::getTagBooklets($id,Config::get("app.locale")) , "groups" => $this->data['groups']))->render();
        return View::make("admin.skin")->nest("content","admin.booklets",$this->data);
    }


    public function update($id)
    {
        Tag::updateTag($id);
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /admin/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}