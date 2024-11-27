<?php

namespace App\Domains\ApplicationDomain\Repositories;

use App\Domains\ApplicationDomain\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Domains\ApplicationDomain\Models\Application;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll()
    {
        return Application::with(['user', 'job'])->get(); // Não precisa de 'recruiter'
    }

    public function find(int $id)
    {
        return Application::with(['user', 'job'])->findOrFail($id); // Não precisa de 'recruiter'
    }

    public function create(array $data)
    {
        return Application::create($data);
    }

    public function update($application, array $data)
    {
        $application->update($data);
        return $application;
    }

    public function delete($application)
    {
        $application->delete();
    }
}
