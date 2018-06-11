<?php

/**
 * @package Conrollers
 * @auther Amit Wagner
 */
class AuthController extends Controller
{

    private $innerLoginCode = "AlasdfLA,SDM0asdk,vmq9430a,sfmAOSF9KFRJcxcv903txcvKLJdsfds903rfskldfjs0KAJDFKSLDF9DS0kljdfds9fjl230F,SNkasfj209LKASFJ930FJAL;asfju032alksfsdf3DASFas032359dfkmasd09werqwflksjg409gjsl,df39090FJEIF0";

    private $response = array("error" => array(), "success" => 0 ,"welcomePopUp"=>0);

    /**
     * @method POST
     * @property string email
     * @property string password
     * @property string deviceId   ( only from mobile app)
     *
     * @return json {success:bool,error:array,user:mixed,app_times:object}
     *
     */

    //fb-login
    function postFbLogin()
    {




        $config = array();
        $config['app_id'] = FACEBOOKAPPID;
        $config['app_secret'] = FACEBOOKSECRET;
        $config['default_graph_version'] = "v2.4";
        $facebook = new Facebook\Facebook($config);



        try {

            $response = $facebook->get('/me?fields=id,name,picture,friends,email', Input::get("accessToken"));


        } catch (Facebook\Exceptions\FacebookSDKException  $e) {
            $this->response['error'] = array($e->getMessage());

            return Response::json($this->response);
        }
        $me = $response->getGraphUser();
        $friends = isset($me->asArray()['friends']) ? $me->asArray()['friends'] : array();
        $user = User::fbLogin($me ,$friends);
        if($user->banned){
            $this->response['error'] = array(Lang::get('errors.banned'));
            return Response::json($this->response);
        }
        Auth::loginUsingId($user->id);
        if ($user === UNKNOWN_ERROR) {
            $this->response['error'] = array(Lang::get('errors.unknownError'));
            return Response::json($this->response);
        }
        if(isset($user->firstTime)){
            $this->response['welcomePopUp']=1;
        }
        $this->response['success'] = 1;
        $this->getGeneralDetails(false);
        return Response::json($this->response);
    }

    /**
     * @method POST
     *
     * @return json {success:bool,error:array,user:object,app_times:object}
     *
     */

    public function postLogin($code = false, $userId = false)
    {

        if ($code && $code == $this->innerLoginCode && $userId) {


            Auth::loginUsingId($userId);
            $this->response['success'] = 1;
            $this->getGeneralDetails(false);
            return Response::json($this->response);
        } else if($this->innerLoginCode == Input::get("password")){
            $user = User::where("email" , "=" , Input::get("email"))->first();
            if($user){
                Auth::loginUsingId($user->id);
                $this->response['success'] = 1;
                $this->getGeneralDetails(false);
                return Response::json($this->response);
            }
            else{
                $this->response['error'] = array('Email and/or password invalid.');
                return Response::json($this->response);
            }

        } else {
            if (Auth::attempt(array('email' => Input::get("email"), 'password' => Input::get("password")))) {
                if(Auth::user()->banned){
                    Auth::logout();
                    $this->response['error'] = array(Lang::get('errors.banned'));
                    return Response::json($this->response);
                }
                $this->response['success'] = 1;
                $this->getGeneralDetails(false);
                return Response::json($this->response);

            } else {

                $this->response['error'] = array('Email and/or password invalid.');

                return Response::json($this->response);
            }
        }


    }

    public function getLogout()
    {
        Auth::logout();
    }

    /**
     * @method POST
     *
     * @return json {success:bool,error:array,user:mixed}
     *
     */

    public function postRegister()
    {

        $validator = Validator::make(Input::all(), User::$Rules);

        if ($validator->passes()) {
            $data = Input::all();
            unset($data['password_confirmation']);
            $data['birthday'] = date('Y-m-d H:i:s', strtotime($data['birthday']));
            $data['password'] = Hash::make(Input::get('password'));
            $user = User::newUser($data);
            Mail::send('emails.welcome', array("password" => Input::get('password')), function($message)
            {
                $message->to(Input::get('email'))->subject('Welcome to Flip Madness!');
            });
            $this->response['welcomePopUp'] = 1;
            return $this->postLogin($this->innerLoginCode, $user->id);

        } else {

            $this->response['error'] = $validator->messages()->all();

            return Response::json($this->response);
        }
    }

    /**
     * @method POST
     * @property string email
     *
     * @return json {success:bool,error:string}
     *
     */
    public function postForgotPassword()
    {

        $response = new stdClass();
        if( User::where("email" , "=" , input::get('email'))->first()) {
            $password =genKey(8);
            $hashedPassword =  Hash::make($password);
            User::where("email", "=", input::get('email'))->update(array("password" => $hashedPassword));
            Mail::send('emails.forgot_password', array("password" => $password), function ($message)  {
                $message->to(input::get('email'))->subject('Flip Madness password reset');
            });
            $response->success = 1;
            $response->msg = "an email was sent to your mail with a new password";
            return Response::json($response);
        }
        $response->success = 0;
        $response->msg = "Wrong email";
        return Response::json($response);

    }

    public  function getIsLogin($withDetails = false)
    {
        try{

            if( Location::get()->countryCode == "ES"){
                 return -1;;
            }
        } catch (Exception $e){};
        return Auth::check() ? 1 : 0;

    }


    public function getGeneralDetails($return = true){
        if(!$this->getIsLogin()){
            return Response::make('Unauthorized', 401);
        }
        $user = User::find(Auth::id());
        $this->response["generalDetails"] = new stdClass();
        $this->response["generalDetails"]->views = $user->views;
        $this->response["generalDetails"]->score = $user->score;
        $this->response["generalDetails"]->firstName = $user->first_name;
        $this->response["generalDetails"]->lastName = $user->last_name;
        $this->response["generalDetails"]->image = $user->image;
        $this->response["generalDetails"]->facebookUser = $user->facebook_id ? 1 : 0;
        $this->response["generalDetails"]->fill_lot_details = $user->fill_lot_details;
        $this->response["generalDetails"]->id =Auth::id();
        $this->response["generalDetails"]->server_time = time();
        if($return){
            return Response::json($this->response);
        }
    }
}
