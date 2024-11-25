<?php

namespace App\Domains\JobDomain\Repositories\Contracts;

interface JobRepositoryInterface
{
    public function getJobsByRecruiter(int $recruiterId);
    public function find(int $jobId);
    public function create(array $data);
    public function update($job, array $data);
    public function delete($job);
    public function checkExistingApplication(int $userId, int $jobId): bool;
    public function createApplication(array $data);
}
