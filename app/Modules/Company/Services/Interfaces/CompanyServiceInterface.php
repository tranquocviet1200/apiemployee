<?php

namespace App\Modules\Company\Services\Interfaces;

interface CompanyServiceInterface 
{
    public function getAll();
    public function create($request);
    public function updateById($request, $id);
    public function getById($id);
    public function deleteById($id);
}