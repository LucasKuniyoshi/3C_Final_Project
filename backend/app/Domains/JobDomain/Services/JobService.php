<?php

namespace App\Domains\JobDomain\Services;

use App\Domains\ApplicationDomain\Models\Application;
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

    public function checkExistingApplication(int $userId, int $jobId): bool
    {
        return Application::where('user_id', $userId)
                        ->where('job_id', $jobId)
                        ->exists();
    }

    public function applyToJob(int $userId, $job, array $data)
    {
        $resumePath = null;


        if (isset($data['resume'])) {
            $resumePath = $data['resume']->store('resumes', 'public');
        }


        return $this->createApplication([
            'user_id' => $userId,
            'job_id' => $job->id,
            'name' => auth()->user()->name,
            'recruiter_name' => $job->company->name,
            'additional_info' => $data['additional_info'] ?? null,
            'resume_path' => $resumePath,
        ]);
    }


    public function createApplication(array $data)
    {
        return Application::create($data);
    }
}
