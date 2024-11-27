<?php

namespace App\Domains\JobDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\JobDomain\Validators\JobValidator;
use App\Domains\JobDomain\Services\Contracts\JobServiceInterface;

class JobController extends Controller
{
    protected $jobService;
    protected $jobValidator;

    public function __construct(JobServiceInterface $jobService, JobValidator $jobValidator)
    {
        $this->jobService = $jobService;
        $this->jobValidator = $jobValidator;
    }

    public function index(Request $request)
    {

        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $jobs = $this->jobService->getJobsByRecruiter(auth()->id());

        if ($request->has('departament')) {
            $jobs = $jobs->where('departament', $request->departament);
        }

        return response()->json($jobs);
    }

    public function show($id)
    {
        $job = $this->jobService->getJobById($id);
        return response()->json($job);
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $validatedData = $this->jobValidator->validateJobCreation($request);

        $job = $this->jobService->createJob(array_merge($validatedData, ['recruiter_id' => auth()->id()]));

        return response()->json($job, 201);
    }

    public function update(Request $request, $id)
    {


        $job = $this->jobService->getJobById($id);

        if ($job->recruiter_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized to update this job.'], 403);
        }

        $validatedData = $this->jobValidator->validateJobUpdate($request);

        $this->jobService->updateJob($job, $validatedData);

        return response()->json($job);
    }

    public function destroy($id)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $job = $this->jobService->getJobById($id);

        if ($job->recruiter_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized to delete this job.'], 403);
        }

        $this->jobService->deleteJob($job);

        return response()->json(['message' => 'Job deleted successfully']);
    }

    public function apply(Request $request, $id)
    {
        if (auth()->user()->user_type !== 'candidate') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $job = $this->jobService->getJobById($id);

        if ($this->jobService->checkExistingApplication(auth()->id(), $job->id)) {
            return response()->json(['message' => 'You have already applied for this job.'], 400);
        }

        $application = $this->jobService->applyToJob(auth()->id(), $job, $request->all());

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }
}
