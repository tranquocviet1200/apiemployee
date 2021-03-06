<?php

namespace App\Modules\Company\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function create($validated);
    public function getById($id);
    public function updateById($validated, $id);
    public function deleteById($id);
}