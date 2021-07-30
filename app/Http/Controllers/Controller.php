<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //definig global methods to use all controllers 
   // to send json response
    public static function sendSuccess($data,$message='Successfully Response',$status=200,$success=true)
    {
        return response()->json(['status'=>$status,'success'=>$success,'data'=>$data,'message'=>$message]);
    }//sendSuccess method close


    public static function sendError($message='',$status=200,$success=false)
    {
        return response()->json(['status'=>$status,'success'=>$success,'message'=>$message]);
    }//sendError method close
}
