<?php

namespace App\Modules\User\Services;

use App\Helpers\TransformerResponse;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Modules\User\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface 
{
    private $transformerReponse;
    private $userRepository;
    const LOGIN_SUCESS = "Login Success";
    const LOGIN_FAILED = "Login Failed";

    public function __construct(
        TransformerResponse $transformerReponse,
        UserRepositoryInterface $userRepository
    )
    {
        $this->transformerReponse = $transformerReponse;
        $this->userRepository = $userRepository;
    }

    public function login($request)
    {
        try {
            $validated = $request->validated();

            if (Auth::attempt($validated)) {
                $user = auth()->user();
                $token = Auth::user()->createToken('user')->accessToken;
                return $this->transformerReponse->response(
                    false,
                    [
                        'user' => $user, 
                        'token' => $token,
                    ],
                    TransformerResponse::HTTP_OK, 
                    self::LOGIN_SUCESS
                );
            } else {
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_UNAUTHORIZED,
                    self::LOGIN_FAILED
                );
            }

        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function register($request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($validated['password']);
            $user = $this->userRepository->create($validated);
            return $this->transformerReponse->response(
                false,
                [
                    'user' => $user,
                ],
                TransformerResponse::HTTP_CREATED,
                TransformerResponse::CREATE_SUCCESS_MESSAGE

            );

        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function getCurrentUser()
    {
        try {
            $user = auth()->user();

            return $this->transformerReponse->response(
                false,
                [
                    'user' => $user,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE

            );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
    }
}
}