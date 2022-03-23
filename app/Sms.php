<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public static function sendSms($message, $mobile){
        $request ="";
        $param['authorization']="WkpnYTBkaWRGQ2FUWHhBVG40NjR6YUhKNUhjRVlJQTA6bm9mSjBjSG9ob2l5anpHcg==";
        $param['sender_id'] = 'ZJga0didFCaTXxATn464zaHJ5HcEYIA0';
        $param['body']= $message;
        $param['to']= $mobile;
        $param['language']="english";
        $param['route']="p";

        foreach($param as $key=>$val) {
            $request.= $key."=".urlencode($val);
            $request.= "&";
        }
        $request = substr($request, 0, strlen($request)-1);

        $url ="https://www.fast2sms.com/dev/bulk?".$request;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
    }
}
