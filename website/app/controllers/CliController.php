<?php

class CliController extends \BaseController {



    public function getNotifyTop3($key)
    {
        if($key != "asdwk3w0rlsadfmslkdjf4093erlkfjslkdfj9403rslkdjfkldsjfKJHSAF8324UHASMCHSZJkjzhf3rsdjf"){
            return;
        }

        $res = User::orderBy("score" , "desc")->take(3)->get();
        $msg = "<div>Top 3 </div>";
        foreach($res as $obj)
        {
            $msg.="<div> <b>User id:</b> {$obj->id} <b>Name:</b> {$obj->first_name} {$obj->last_name} <b>Email:</b> {$obj->email} </div>";
            Notifications::create(array("user_id" => $obj->id , 'type' => "top score" , "free_text"=>"Congratulates you're one of the best 3  FLIPPERS this month! An amazing prize will be sent to you!" ,  "show_method" => "box"));
            Mail::send('emails.top3', array(), function($message) use($obj)
            {
                $message->to($obj->email, $obj->first_name)->subject('CONGRATULATIONS, YOUR A TOP FLIPPER!');
            });

        }
        Mail::send('emails.admintop3', array("msg" =>$msg), function($message) use($obj)
        {
            $message->to("info@fbfsports.com")->subject('top 3 player for date:' . date("d m Y",time()));
        });
    }


    public function getUpdateWinners($key)
    {
        if($key != "asdwk3w0rlsadfmslkdjf4093erlkfjslkdfj9403rslkdjfkldsjfKJHSAF8324UHASMCHSZJkjzhf3rsdjf"){
            return;
        }
        Lotteries::updateWinners();
    }

}
