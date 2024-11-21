<?php

namespace App\Domains\ApplicationDomain\Services;

use App\Domains\ApplicationDomain\Services\Contracts\ApplicationServiceInterface;
use App\Domains\ApplicationDomain\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Models\Application;

class ApplicationService implements ApplicationServiceInterface
{
    protected $applicationRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function getAllApplications()
    {
        return $this->applicationRepository->getAll();
    }

    public function getApplicationById(int $id)
    {
        return $this->applicationRepository->find($id);
    }

    public function createApplication(array $data)
    {
        return $this->applicationRepository->create($data);
    }

    public function updateApplication($application, array $data)
    {
        return $this->applicationRepository->update($application, $data);
    }

    public function deleteApplication($application)
    {
        return $this->applicationRepository->delete($application);
    }
}
