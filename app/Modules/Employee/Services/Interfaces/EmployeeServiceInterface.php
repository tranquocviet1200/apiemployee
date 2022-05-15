<?php

namespace App\Modules\Employee\Services\Interfaces;

interface EmployeeServiceInterface
{
    public function getAll();
    public function getById($id);
    public function create($request);
    public function updateById($request, $id);
    public function deleteById($id);
    public function getEmployeeListOfCompany($company_id);
}