<?php
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;


class AdminCategoryController extends Controller {


    public function __construct(){
        Assets::add(url()."/public/js/tai/taipages/categories.js");
    }

    public function index()
    {


        $this->data['cats'] = View::make("admin.components.categories",array("cats" =>Categories::getCategoriesByLang(Config::get("app.locale"))))->render();
        return View::make("admin.skin")->nest("content","admin.category",$this->data);
    }


    public function store()
    {

        Categories::storeCategory();
        return View::make("admin.components.categories",array("cats" =>Categories::getCategoriesByLang(Config::get("app.locale"))))->render();

    }

    public function show($id)
    {
        $this->data['cat'] = Categories::getCategory($id,Config::get("app.locale"));
        $this->data['tags'] = View::make("admin.components.tags",array("tags" =>Tag::getCategoryTags($id,Config::get("app.locale"))))->render();
        return View::make("admin.skin")->nest("content","admin.tags",$this->data);
    }


    public function update($id)
    {
        Categories::updateCategory($id);
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
        //
    }

}