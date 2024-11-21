<?php

namespace App\Domains\CompanyDomain\Repositories;

use App\Domains\CompanyDomain\Models\Company;
use App\Domains\CompanyDomain\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{

    public function all(): Collection
    {
        return Company::all();
    }
    public function findById(int $id): ?Company
    {
        return Company::find($id);
    }
    public function create(array $data): Company
    {
        return Company::create($data);
    }
    public function update(Company $company, array $data): bool
    {
        return $company->update($data);
    }
    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}
