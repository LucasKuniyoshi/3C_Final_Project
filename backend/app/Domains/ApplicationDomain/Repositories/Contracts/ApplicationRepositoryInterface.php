<?php

namespace App\Domains\ApplicationDomain\Repositories\Contracts;

interface ApplicationRepositoryInterface
{
    public function getAll();
    public function find(int $id);
    public function create(array $data);
    public function update($application, array $data);
    public function delete($application);
}
