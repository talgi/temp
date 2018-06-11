<?php  
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;


class AdminController extends Controller {

	public function getIndex()
	{
		return View::make("admin.skin")->nest("content","admin.main");
	}

	public function getRegister()
	{


		return  View::make("admin.skin_login")->nest("content","admin.register");
	
	}

	public function postRegister()
	{
		
		 $validator = Validator::make(Input::all(), User::adminRuls());
		
		 if ($validator->passes()) 
		 {
		       	$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->role='admin';
			$user->save();
			return Redirect::to(CMS_NAME.'/login');
		}
		 else
		 {
		         
		          return Redirect::to(CMS_NAME.'/register')->withErrors($validator);
		 }
	}

	public function getLogin()
	{

		return  View::make("admin.skin_login")->nest("content","admin.login");
	}

	public function postLogin()
	{

		if (Auth::attempt(array('email' => Input::get("email"), 'password' => Input::get("password")) , true))
		{
		    	return Redirect::intended(CMS_NAME);
		}
		else
		{
			
			$errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
			return Redirect::back()->withErrors($errors)->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to(CMS_NAME."/login");
	}

    public function getImportcsv()
    {
        $file = fopen(base_path().'../../codes.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            //$line is an array of the csv elements
           // print_r($line);

            $obj = new stdClass();
            $obj->title = trim($line[0]);
            $tag_id = trim($line[1]);
            $obj->points = trim($line[2]);
            $obj->prefix = trim($line[3]);
            $obj->copies = str_replace(",","", $line[4]);
            Booklet::storeBooklet($tag_id,$obj);

        }
        fclose($file);

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