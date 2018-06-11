<?php

class AdminMangeUsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        Assets::add(url()."/public/js/tai/taipages/mange-users.js");
        $data = array();
        $data['prizes'] = HomePrizes::getPrizes();
        return View::make("admin.skin")->nest("content","admin.mange-users",$data);
	}

    public function getRecords()
    {
        return Response::json(User::getAdminSearch(Input::get("search")['value'] ,Input::get("start")  ,Input::get("length") ));
    }

    public  function postBan()
    {
        $user = User::find(Input::get("userId"));
        $user->banned = Input::get("ban");
        $user->save();
    }
    public function getExport()
    {
        $res = User::getUsersToExport();
        array_unshift($res,array("email" ));

        $this->download_send_headers("users.csv");

        echo $this->array2csv($res);
        die();
    }
    private function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fwrite($df, "\xEF\xBB\xBF");
        foreach ($array as $row) {

            fputcsv($df, $row);
        }
        fclose($df);

        return ob_get_clean();
    }


    private function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}
