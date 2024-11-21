<?php

namespace App\Domains\CompanyDomain\Repositories\Contracts;

use App\Domains\CompanyDomain\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function all(): Collection;
    public function findById(int $id): ?Company;
    public function create(array $data): Company;
    public function update(Company $company, array $data): bool;
    public function delete(Company $company): bool;
}
