<?php
namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Requests\CreateCompanyRequest;
use App\Modules\Company\Requests\UpdateCompanyRequest;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getAll()
    {
        return $this->companyService->getAll();
    }

    public function create(CreateCompanyRequest $request)
    {
        return $this->companyService->create($request);
    }

    public function updateById(UpdateCompanyRequest $request, $id)
    {
        return $this->companyService->updateById($request, $id);
    }

    public function getById($id)
    {
        return $this->companyService->getById($id);
    }

    public function deleteById($id)
    {
        return $this->companyService->deleteById($id);
    }
}