<?php

namespace App\Modules\Employee\Repositories;

use App\Modules\Employee\Models\Employee;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function create($validated)
    {
        return Employee::create($validated);
    }

    public function getAll()
    {
       return Employee::all();
    }

    public function getById($id)
    {
        return Employee::find($id);
    }

    public function updateById( $validated, $id)
    {
        $employee = Employee::where('id',$id);
        $employee->name = $validated["name"];
        $employee->email = $validated["email"];
        $employee->position = $validated["position"];
        $employee->company_id = $validated["company_id"];
        $employee->save();
        return $employee;
    }

    public function deleteById($id)
    {
        return Employee::find($id)->delete();
    }

    public function getEmployeeListOfCompany($company_id)
    {
        return Employee::where('company_id', $company_id);
    }
}