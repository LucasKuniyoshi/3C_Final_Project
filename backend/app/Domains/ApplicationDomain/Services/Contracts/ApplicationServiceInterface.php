<?php

namespace App\Domains\ApplicationDomain\Services\Contracts;

interface ApplicationServiceInterface
{
    public function getAllApplications();
    public function getApplicationById(int $id);
    public function createApplication(array $data);
    public function updateApplication($application, array $data);
    public function deleteApplication($application);
}

