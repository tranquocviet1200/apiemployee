<?php

namespace App\Modules\Employee\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function create($validated);
    public function getAll();
    public function getById($id);
    public function deleteById($id);
    public function updateById( $validated, $id);
    public function getEmployeeListOfCompany($company_id);
}