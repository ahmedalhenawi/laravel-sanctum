<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Requests\Users\CreateUserRequest;
use App\Requests\Users\LoginUserRequest;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    public UserServices $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices ;
    }

    public function register( CreateUserRequest $createUserRequest)
    {
        if (!empty($createUserRequest->getErrors())){
            return $this->apiResponse($createUserRequest->getErrors() , 'failed' , 406);
        }
        $user = $this->userServices->createUser($createUserRequest->request()->all());
        $message['token'] = $user->createToken(env('APP_NAME'))->plainTextToken ;
        $message['user'] = $user;
        return $this->apiResponse($message);
    }
    public function login(LoginUserRequest $loginUserRequest): \Illuminate\Http\JsonResponse
    {
        if (!empty($loginUserRequest->getErrors())){
            return $this->apiResponse($loginUserRequest->getErrors() , 'failed' , 406);
        }
        $request = $loginUserRequest->request();
        if(Auth::attempt(['email'=>$request->email , 'password'=> $request->password] ,1)){
            $user = Auth::user();
            $success['token'] =  $user->createToken('token' , ['api:products'])->plainTextToken ;
            $success['name'] = $user->name;
            return $this->apiResponse($success , 'user login successfully');
        }else{
            return $this->apiResponse('unauthorized' , 'failed login' , 401);

        }

    }

    public function products(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        if ($user->tokenCan('api:products')) {
            $products = Product::get();
            return $this->apiResponse($products);
        }
        return $this->apiResponse('not authorized');

    }
}
