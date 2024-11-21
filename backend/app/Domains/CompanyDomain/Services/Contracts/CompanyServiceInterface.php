<?php

namespace App\Domains\CompanyDomain\Services\Contracts;

use App\Domains\CompanyDomain\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyServiceInterface
{
    public function getAllCompanies(): Collection;
    public function getCompanyById(int $id): ?Company;
    public function createCompany(array $data): Company;
    public function updateCompany(int $id, array $data): bool;
    public function deleteCompany(int $id): bool;
}
