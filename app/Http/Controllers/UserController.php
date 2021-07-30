<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
#loding models 
use App\User; 
use Illuminate\Support\Facades\Auth; 

//loading external validation requests
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(LoginRequest $request){     
        if(!$request->validated()):

            return $this->sendError("All flied requred");
        endif;  

        //checking user login details from db
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 

            $user = Auth::user(); 
            $data['id']          = $user->id;
            $data['name']        = $user->name;
            $data['email']       = $user->email;

            //generate rating accessToken token using passport token

            $data['token'] = $user->createToken('API Token')->accessToken; 

            //sending required data to user after successfull login

            //calling base controller method for sending response for api
            return $this->sendSuccess($data,"User retrived successfully"); 
        } 
        else{ 
            //if user entered wrong login details

            //calling base controller method for sending response for api
            return $this->sendError("Unauthorised");
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(RegisterRequest $request) 
    {   
         $input = $request->all(); 
         $input['password'] = bcrypt($input['password']); 
         $user = User::create($input); 
         $data['id']          = $user->id;
         $data['name']        = $user->name;
         $data['email']       = $user->email;

            //generate rating accessToken token using passport token
            $data['token'] = $user->createToken('API Token')->accessToken;
 

            //sending required data to user after successfull register

            //calling base controller method for sending response for api
            return $this->sendSuccess($data,"User registered successfully"); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}