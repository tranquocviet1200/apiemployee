<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Requests\UserLoginRequest;
use App\Modules\User\Requests\UserRegisterRequest;
use App\Modules\User\Services\Interfaces\UserServiceInterface;

class UserController extends Controller 
{
    private $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User Login
     * @param $requets
     * @return Reponse
     */
    public function login(UserLoginRequest $request)
    {
        return $this->userService->login($request);
    }

    /**
     * User Register
     * @param $requets
     * @return Reponse
     */
    public function register(UserRegisterRequest $request)
    {
        return $this->userService->register($request);
    }

    /**
     * Get Current User
     */
    public function getCurrentUser()
    {
        return $this->userService->getCurrentUser();
    }
}