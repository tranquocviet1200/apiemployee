<?php

namespace App\Modules\Employee\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use App\Modules\Employee\Requests\CreateEmployeeRequest;
use App\Modules\Employee\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller 
{

    private $employeeService;

    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function create(CreateEmployeeRequest $request)
    {
       return $this->employeeService->create($request);
        
    }

    public function getAll()
    {
        return $this->employeeService->getAll();
       
    }

    public function getById($id)
    {
        return $this->employeeService->getById($id);
    }

    public function updateById(UpdateEmployeeRequest $request, $id)
    {
        return $this->employeeService->updateById($request, $id);
        
    }

    public function deleteById($id)
    {
        return $this->employeeService->deleteById($id);        

    }

    public function getEmployeeListOfCompany($company_id)
    {    
        return $this->employeeService->getEmployeeListOfCompany($company_id);   
    }
}