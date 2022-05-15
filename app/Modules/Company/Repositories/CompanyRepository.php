<?php

namespace App\Modules\Company\Repositories;

use App\Modules\Company\Models\Company;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll()
    {
        return Company::all();
    }

    public function getById($id)
    {
        return Company::find($id);
    }

    public function create($validated)
    {
        return Company::create($validated);
    }

    public function deleteById($id)
    {
        return Company::where('id', $id)->delete();       
    }

    public function updateById($validated, $id)
    {
        $company = Company::where('id',$id);
        $company->name = $validated["name"];
        $company->address = $validated["address"];
        $company->save();
        return $company;                 
    }


}