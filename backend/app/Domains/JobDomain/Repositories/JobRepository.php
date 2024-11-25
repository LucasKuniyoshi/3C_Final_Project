<?php

namespace App\Domains\JobDomain\Repositories;

use App\Domains\JobDomain\Repositories\Contracts\JobRepositoryInterface;
use App\Domains\JobDomain\Models\Job;
use App\Domains\ApplicationDomain\Models\Application;

class JobRepository implements JobRepositoryInterface
{
    public function getJobsByRecruiter(int $recruiterId)
    {
        return Job::where('recruiter_id', $recruiterId)->get();
    }

    public function find(int $jobId)
    {
        return Job::findOrFail($jobId);
    }

    public function create(array $data)
    {
        return Job::create($data);
    }

    public function update($job, array $data)
    {
        $job->update($data);
        return $job;
    }

    public function delete($job)
    {
        $job->delete();
    }

    public function checkExistingApplication(int $userId, int $jobId): bool
    {

        return Application::where('user_id', $userId)
                          ->where('job_id', $jobId)
                          ->exists();
    }

    public function createApplication(array $data)
    {

        return Application::create($data);
    }
}
