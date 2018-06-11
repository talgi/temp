<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $fillable = array('email', 'first_name', 'last_name', 'password', 'birthday', 'facebook_id', 'image',"address","city","country","phone",  "banned","fill_lot_details");
	protected $hidden = array('password', 'remember_token');

    public static function getUsersToExport()
    {
        DB::setFetchMode(PDO::FETCH_ASSOC);
        return DB::table("users")->select("email")->get();
    }
    public static function updateUser($data){
        if(isset($data['image'])){
            $file = self::where("id" , "=" , Auth::id())->first()->image;
            if($file && file_exists(PATH_UPLOAD.$file)){
                unlink(PATH_UPLOAD.$file);
            }
        }
        self::where("id" , "=" , Auth::id())->update($data);
        Lotteries::enterUserToLotteryCat(Auth::id());
    }
    public static function getAdminSearch($search, $start, $length)
    {
        $sql = DB::table("users")
            ->leftJoin(DB::raw("(select count(user_id) as total_booklets ,user_id from codes group by (user_id)) as c"),function($join){
                $join->on( "c.user_id" ,"=" ,"users.id");

            })
            ->select("c.total_booklets","users.id", "email", "city", "country", "first_name", "last_name" ,"score" ,"phone" ,"address" ,"banned","facebook_id","postal");
        $response = new stdClass();
        if ($search) {
            $sql->where("users.id", "=", $search)
                ->orWhere("email", "like", "%{$search}%")
                ->orWhere("city", "like", "%{$search}%")
                ->orWhere("country", "like", "%{$search}%")
                ->orWhere("first_name", "like", "%{$search}%")
                ->orWhere("last_name", "like", "%{$search}%")
                ->orWhere("address", "like", "%{$search}%");
            $response->recordsFiltered = $sql->count();
        }

        $res = $sql->skip($start)->take($length)->get();


        $response->recordsTotal = DB::table("users")->count();
        if (!$search) {
            $response->recordsFiltered = $response->recordsTotal;
        }
        $response->data = array();
        foreach ($res as $key => $obj) {

            $response->data[$key] = new stdClass();
            $response->data[$key]->id = $obj->id;
            $response->data[$key]->name = $obj->first_name." ".$obj->last_name;
            $response->data[$key]->email = $obj->email;
            $response->data[$key]->score = $obj->score;
            $response->data[$key]->phone = $obj->phone;
            $response->data[$key]->city = $obj->city;
            $response->data[$key]->address = $obj->address;
            $response->data[$key]->country = $obj->country;
            $response->data[$key]->total_booklets = $obj->total_booklets;
            $response->data[$key]->postal = $obj->postal;
            $response->data[$key]->facebook = $obj->facebook_id ? "yes" : "no";
            $checked = $obj->banned ? "selected" : "";
            $select = "<select class='banned' data-userid='{$obj->id}'>
                <option  value='0'>not active</option>
                <option $checked value='1'>active</option>
            </select>";
            $response->data[$key]->banned = $select;
        }

        return $response;
    }
	public static function adminRuls(){  
		$adminRuls = array(
			'email'=>'required|email|unique:users',
			'password'=>'required|alpha_num|between:8,12|confirmed',
			'password_confirmation'=>'required|alpha_num|between:8,12',
		);
		$adminRuls['registration_key'] = "required|in:".REGISTRATION_KEY;

		return $adminRuls;
	}

    public static function getTopFriendsRanked($userId)
    {
        $res =  DB::table("user_friends")
            ->join("users", "users.facebook_id", "=", "user_friends.user_friends_facebook_id")
            ->where("user_friends.user_id", "=", $userId)
            ->orWhere("users.id" , "=" ,$userId)
            ->orderBy("score", "desc")
            ->select("score", "first_name", "last_name", "image" ,"users.id as user_id")
            ->take(10)
            ->distinct()
            ->get();

        if (Auth::check()) {
            $userInList = false;
            foreach ($res as $obj) {
                if ($obj->user_id == Auth::id()) {
                    $userInList = true;
                    break;
                }
            }
            if (!$userInList) {
                $obj = new stdClass();
                $obj->rank =DB::table("user_friends")
                    ->join("users", "users.facebook_id", "=", "user_friends.user_friends_facebook_id")
                    ->where("user_friends.user_id", "=", $userId)
                    ->orWhere("users.id" , "=" ,$userId)
                    ->where("users.score" ,">=" ,Auth::user()->score )
                    ->count();
                $obj = new stdClass();
                $obj->score =  Auth::user()->score;
                $obj->first_name = Auth::user()->first_name;
                $obj->last_name = Auth::user()->last_name;
                $obj->image = Auth::user()->image;
                $obj->user_id = Auth::user()->user_id;
                $res[] = $obj;
            }

        }

        return $res;
    }


    public static $Rules = array(
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|between:6,20|confirmed',
        'password_confirmation' => 'same:password',
        'first_name' => 'required|alpha|between:2,50',
        'last_name' => 'required|alpha|between:2,50',
        "birthday" => 'required|date_format:d-m-Y',
    );

    public static function updateRules() {
        Validator::extend('is_user_password', function($attribute, $value, $parameters)
        {


            return Hash::check($value,self::where("id","=",Auth::id())->first()->password);

        });


        $arr = array(
            'email' => 'email|unique:users',
            'password' => 'alpha_num|between:6,20',
            'first_name' => 'required|alpha|between:2,50',
            'last_name' => 'required|alpha|between:2,50',
            "birthday" => 'required|date_format:d-m-Y',
            "country" => 'required|between:2,100',
            "city" => 'required|between:2,100',
            "address" => 'required|max:50',
            "postal" => 'required|max:50',
            "phone" => 'required|alpha_num|max:20',
            "verify_password"=>"required|alpha_num|between:6,20|is_user_password",

        );

        return $arr;
    }

    public static function joinRules()
    {
        $arr = array(

            "country" => 'required|between:2,100',
            "city" => 'required|between:2,100',
            "address" => 'required',
            "phone" => 'required|alpha_num|max:20',
            "postal" => 'required|max:50',


        );

        return $arr;
    }
    public static function newUser($data)
    {


        return self::create($data);
    }

    public static function getLoginDetails($userId)
    {
        $res = self::select(array("score", "id", "facebook_id", "first_name", "last_name"))->where("id", "=", $userId)->first();
        if ($res) {
            $obj = new stdClass();
            $obj->name = $obj->first_name . " " . $obj->last_name ;
            $obj->isFacebook = $res->facebook_id ? 1 : 0 ;
            $obj->score = $res->score ;
        }else{
            return 0;
        }
    }


    public static function fbLogin($user_profile, $friends)
    {

        $user = DB::table("users")->where("facebook_id" ,"=" ,$user_profile['id'])->first();
        if($user){

            self::updateUserFbFriends($user->id, $friends);
            return $user;
        } else {
            $user = DB::table("users")->where("email", "=", $user_profile['email'])->first();
            if ($user) {
                DB::table("users")->where("email", "=", $user_profile['email'])->update(array("facebook_id" => $user_profile['id']));
                $user->facebook_id = $user_profile['id'];
                self::updateUserFbFriends($user->id, $friends);
                return $user;
            }
            $sendPassword = genKey(8);
            $password = Hash::make($sendPassword);

            if ($user_profile['picture']['url']) {
                $url = $user_profile['picture']['url'];
                $faceRes = file_get_contents($url);
                $fileName = PATH_UPLOAD . "fb_profilepic_{$user_profile['id']}.jpg";
                $imgName = "fb_profilepic_{$user_profile['id']}.jpg";
                $file = fopen($fileName, 'w+');
                fputs($file, $faceRes);
                fclose($file);
            }
            else{
                $imgName = "";
            }


            $data = array("email" => $user_profile['email'], "password" => $password, "facebook_id" => $user_profile['id'], 'image' => $imgName);
            $name = explode(" ",$user_profile['name']);
            if(!empty($name))
            $data['first_name'] = $name[0];
            $data['last_name'] = isset($name[1]) ? $name[1] : "";
            $user = self::newUser($data);
            Mail::send('emails.welcome', array("password" => $sendPassword), function($message) use($user_profile)
            {
                $message->to($user_profile['email'], $user_profile['name'])->subject('Welcome to Flip Madness!');
            });

            $user->firstTime = 1;
            self::updateUserFbFriends($user->id, $friends);
            return $user;
        }
    }

    public static function updateUserFbFriends($userId, $friends)
    {

        if (count($friends) > 0) {
            $userFriends = DB::table("user_friends")->where("user_id", "=", $userId)->get();

            foreach ($userFriends as $obj) {
                foreach ($friends as $key => $item) {
                    if ($item['id'] == $obj->user_friends_facebook_id) {
                        unset($friends[$key]);
                        break;
                    }
                }
            }

            if (count($friends) == 1) {
                if(self::where("facebook_id" , "="  ,current($friends)['id'])->first()) {
                    Notifications::create(array("user_id" => $userId, "free_text" => "your Facebook friend " . current($friends)['name'] . " just joined WWE Flipmadness", 'type' => "new friend", "show_method" => "box"));
                    DB::table("user_friends")->insert(array("user_id" => $userId, "user_friends_facebook_id" => current($friends)['id']));
                }
            } else {

                $insert = array();
                $notificationsText = "your Facebook friends ";
                $where = array();
                foreach ($friends as $key => $item) {
                   $where[] = $item['id'];
                }

                $friendsList = self::whereIn("facebook_id" , $where)->get();
                $formatedFrinedsList = array();
                foreach($friendsList as $key => $val){
                    $formatedFrinedsList[$val->facebook_id] = $val;
                }
                foreach ($friends as $key => $item) {
                    if(isset($formatedFrinedsList[$item['id']])) {
                        $insert[] = array("user_id" => $userId, "user_friends_facebook_id" => $item['id']);
                        $notificationsText .= $item['name'] . " , ";
                    }
                }
                if (count($insert) > 0) {
                    DB::table("user_friends")->insert($insert);
                    $notificationsText = mb_substr($notificationsText, 0, -2) . " just joined WWE Flipmadness";
                    Notifications::create(array("user_id" => $userId, "free_text" => $notificationsText, 'type' => "new friend", "show_method" => "box"));

                }
            }
        }
    }

    public static function getTopRanked()
    {

        $res = self::select("score", "first_name", "last_name", "image", "id as user_id")->orderBy("score", "desc")->take(10)->get();
        if (Auth::check()) {
            $userInList = false;
            foreach ($res as $obj) {
                if ($obj->user_id == Auth::id()) {
                    $userInList = true;
                    break;
                }
            }
            if (!$userInList) {
                $obj = new stdClass();
                $obj->score =  Auth::user()->score;
                $obj->first_name = Auth::user()->first_name;
                $obj->last_name = Auth::user()->last_name;
                $obj->image = Auth::user()->image;
                $obj->user_id = Auth::user()->user_id;
                $obj->rank = self::where("score", ">=", Auth::user()->score)->count();
                $res[] = $obj;
            }

        }

        return $res;

    }

    public static function increaseView($id)
    {
        $user  = self::find($id);
        $user->views = $user->views + 1;


        $medals = Medals::all();
        foreach($medals as $medal){
            if($medal->views  ==  $user->views){
                User::increaseScore($id,$medal->reword);
                UserMedals::create(array("user_id"=>$user->id , "medal_id" => $medal->id));
                Notifications::create(array("user_id"=>$user->id , "other_table_id" => $medal->id , 'type' => "medal","show_method"=>"box"));


                break;
            }
        }
        $user->save();
        if($obj = Notifications::where("user_id" , "=" , $user->id)->where("type" , "=" ,"views")->first()){
            Notifications::where("user_id" , "=" , $user->id)->where("type" , "=" ,"views")->update(array("free_number" => $obj->free_number+1 , "free_text"=> ($obj->free_number+1)." fliplayers were looking at your album" , 'type' => "views"));
        }
        else{
            Notifications::create(array("user_id"=>$user->id , "free_number" =>1 , "free_text"=> " Someone is looking at your album!" , 'type' => "views" , "show_method"=>"box"));
        }

    }


    public static function increaseScore($userId,$points)
    {
        $user = self::find($userId);
        $user->score =  $user->score + $points;
        $user->save();
        Lotteries::enterUserToLotteryCat($userId);
    }

    public static function getSettings()
    {
        $obj =  self::select("birthday","email" , "first_name" , "last_name" , "address" , "city" , "country" , "phone" , "image","postal")
            ->where('id' , "=" , Auth::id())
            ->first();
        if($obj->birthday) {
            $obj->day = date("d", strtotime($obj->birthday));
            $obj->month = date("m", strtotime($obj->birthday));
            $obj->year = date("Y", strtotime($obj->birthday));
        }

        return $obj;
    }

}
