<?php
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;


class AdminBookletController extends Controller {


    public function __construct(){
        Assets::add(url()."/public/js/tai/taipages/categories.js");
    }




    public function store()
    {
        $obj = new stdClass();
        $obj->points = Input::get("points");
        $obj->prefix = Input::get("prefix");
        $obj->copies = Input::get("copies");
        $obj->title = Input::get("title");
        if(Booklet::storeBooklet(Input::get("tag_id") , $obj) === false)
        {
            return 0;
        }
        return View::make("admin.components.booklet",array("booklets" =>Booklet::getTagBooklets(Input::get("tag_id"),Config::get("app.locale"))))->render();

    }

    public function show($id)
    {

        $this->data['booklet'] = Booklet::getBooklet($id,Config::get("app.locale"));
        $this->data['codes'] = Codes::getBookletList($id);
        return View::make("admin.skin")->nest("content","admin.booklet",$this->data);

    }




    public function update($id)
    {
        Booklet::updateBooklet(Input::all(),$id);
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