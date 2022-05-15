<?php

namespace App\Modules\Employee\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class EmployeeService implements EmployeeServiceInterface
{
    private $transformerReponse;
    private $employeeRepository;
    
    public function __construct(
        TransformerResponse $transformerReponse,
        EmployeeServiceInterface $employeeRepository
    )
    {
        $this->transformerReponse = $transformerReponse;
        $this->employeeRepository = $employeeRepository;
    }

    public function getAll()
    {
        try {
            $employee = $this->employeeRepository->getAll();
            return $this->transformerReponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
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

    public function getById($id)
    {
        try {
            $employee = $this->employeeRepository->getById($id);
            if(empty($employee))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
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

    public function create($request)
    {
        try {
            $validated = $request->validated();
            $employee = $this->employeeRepository->create($validated);
            return $this->transformerReponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
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

    public function updateById($request, $id)
    {
        try {
            $validated = $request->validated();  
            $employee = $this->employeeRepository->getById($id);
            if(empty($employee)) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            $employee = $this->employeeRepository->updateById($validated, $id);         
            return $this->transformerReponse->response(
                false,
                [
                    'employee' => $employee, 
                ],
                TransformerResponse::HTTP_OK, 
                TransformerResponse::UPDATE_SUCCESS_MESSAGE
                
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

    public function deleteById($id)
    {
        try {
            $employee = $this->employeeRepository->deleteById($id);
            if($employee = false) 
                return $this->transformerReponse->response(
                    true,
                    ['employee'=>$employee],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                    false,
                    ['employee'=>$employee],
                    TransformerResponse::HTTP_OK, 
                    TransformerResponse::DELETE_SUCCESS_MESSAGE
                    
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

    public function getEmployeeListOfCompany($company_id)
    {
        try {
            $employee = $this->employeeRepository->getEmployeeListOfCompany($company_id);
            if(empty($employee))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                false,
                [
                    'employee' => $employee,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
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

}