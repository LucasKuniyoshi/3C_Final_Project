<?php

namespace App\Domains\JobDomain\Services\Contracts;

interface JobServiceInterface
{
    public function getJobsByRecruiter(int $recruiterId);
    public function getJobById(int $jobId);
    public function createJob(array $data);
    public function updateJob($job, array $data);
    public function deleteJob($job);
    public function checkExistingApplication(int $userId, int $jobId): bool;
    public function applyToJob(int $userId, $job, array $data);
}
