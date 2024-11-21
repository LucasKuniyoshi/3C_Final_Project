<?php

namespace App\Domains\CompanyDomain\Services;

use App\Domains\CompanyDomain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Domains\CompanyDomain\Models\Company;
use App\Domains\CompanyDomain\Services\Contracts\CompanyServiceInterface;
use App\Domains\CompanyDomain\Validators\CompanyValidator;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{
    protected $companyRepository;
    protected $companyValidator;

    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        CompanyValidator $companyValidator
    ) {
        $this->companyRepository = $companyRepository;
        $this->companyValidator = $companyValidator;
    }

    public function getAllCompanies(): Collection
    {
        return $this->companyRepository->all();
    }

    public function getCompanyById(int $id): ?Company
    {
        return $this->companyRepository->findById($id);
    }

    public function createCompany(array $data): Company
    {

        $this->companyValidator->validateCreate($data);


        return $this->companyRepository->create($data);
    }

    public function updateCompany(int $id, array $data): bool
    {

        $this->companyValidator->validateUpdate($data);

        $company = $this->companyRepository->findById($id);

        if (!$company) {
            throw new \Exception("Company not found.");
        }

        return $this->companyRepository->update($company, $data);
    }

    public function deleteCompany(int $id): bool
    {
        $company = $this->companyRepository->findById($id);

        if (!$company) {
            throw new \Exception("Company not found.");
        }

        return $this->companyRepository->delete($company);
    }
}
