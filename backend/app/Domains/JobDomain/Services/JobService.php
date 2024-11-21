<?php

namespace App\Domains\JobDomain\Services;

use App\Domains\JobDomain\Services\Contracts\JobServiceInterface;
use App\Domains\JobDomain\Repositories\Contracts\JobRepositoryInterface;

class JobService implements JobServiceInterface
{
    protected $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function getJobsByRecruiter(int $recruiterId)
    {
        return $this->jobRepository->getJobsByRecruiter($recruiterId);
    }

    public function getJobById(int $jobId)
    {
        return $this->jobRepository->find($jobId);
    }

    public function createJob(array $data)
    {
        return $this->jobRepository->create($data);
    }

    public function updateJob($job, array $data)
    {
        return $this->jobRepository->update($job, $data);
    }

    public function deleteJob($job)
    {
        return $this->jobRepository->delete($job);
    }
}
