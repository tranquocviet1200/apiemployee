<?php

namespace App\Modules\Company\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CompanyService implements CompanyServiceInterface
{

    private $transformerReponse;
    private $companyRepository;

    public function __construct(
        TransformerResponse $tranformerReponse,
        CompanyRepositoryInterface $companyRepository
    )
    {
        $this->transformerReponse = $tranformerReponse;
        $this->companyRepository = $companyRepository;
    }

    public function create($request)
    {
        try {
            $validated = $request->validated();
            $company = $this->companyRepository->create($validated);
            return $this->transformerReponse->response(
                false,
                [
                    'company' => $company,
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

    public function getAll()
    {
        try {
            $company = $this->companyRepository->getAll();
            return $this->transformerReponse->response(
                false,
                [
                    'company' => $company,
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
            $company = $this->companyRepository->getById($id);
            if(empty($company))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            return $this->transformerReponse->response(
                false,
                [
                    'company' => $company,
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

    public function deleteById($id)
    {
        try {
            $company = $this->companyRepository->deleteById($id);
            if($company = false) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                    false,
                    ['company'=>$company],
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

    public function updateById($request, $id) 
    {
        
        try {
            $validated = $request->validated();  
            $company = $this->companyRepository->getById($id);
            if(empty($company)) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            $company = $this->companyRepository->updateById($validated, $id);         
            return $this->transformerReponse->response(
                false,
                [
                    'company' => $company, 
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
}