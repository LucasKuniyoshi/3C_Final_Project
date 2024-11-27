<?php
namespace App\Domains\JobDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\JobDomain\Models\Job;
use App\Domains\JobDomain\Validators\JobValidator;
use App\Domains\JobDomain\Services\Contracts\JobServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class JobController extends Controller
{
    protected $jobService;
    protected $jobValidator;

    public function __construct(JobServiceInterface $jobService, JobValidator $jobValidator)
    {

        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->jobService = $jobService;
        $this->jobValidator = $jobValidator;
    }

    public function getAllJobs()
{
    $jobs = Job::all();


    return response()->json($jobs);
}
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }
    public function show($id)
{
    $job = Job::find($id);

    if (!$job) {
        return response()->json(['error' => 'Job not found.'], 404);
    }

    return response()->json($job);
}

    public function store(Request $request)
    {
        $this->authorizeUserType('recruiter');
        $validatedData = $this->jobValidator->validateJobCreation($request);
        $jobData = array_merge($validatedData, ['recruiter_id' => auth()->id()]);
        $job = $this->jobService->createJob($jobData);

        return response()->json($job, 201);
    }

    public function update(Request $request, $id)
    {
        $job = $this->getJobOrFail($id);
        $this->authorizeJobOwnership($job);

        $validatedData = $this->jobValidator->validateJobUpdate($request);
        $updatedJob = $this->jobService->updateJob($job, $validatedData);

        return response()->json($updatedJob);
    }

    public function destroy($id)
    {
        $this->authorizeUserType('recruiter');
        $job = $this->getJobOrFail($id);
        $this->authorizeJobOwnership($job);

        $this->jobService->deleteJob($job);

        return response()->json(['message' => 'Job deleted successfully']);
    }

    public function apply(Request $request, $id)
    {
        $this->authorizeUserType('candidate');
        $job = $this->getJobOrFail($id);

        if ($this->jobService->checkExistingApplication(auth()->id(), $job->id)) {
            return response()->json(['message' => 'You have already applied for this job.'], 400);
        }

        $application = $this->jobService->applyToJob(auth()->id(), $job, $request->all());

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }

    protected function authorizeUserType($userType)
    {
        if (auth()->user()->user_type !== $userType) {
            throw new AccessDeniedHttpException('Unauthorized.');
        }
    }

    protected function getJobOrFail($jobId)
    {
        $job = Job::find($jobId);
        if (!$job) {
            throw new NotFoundHttpException('Job not found.');
        }
        return $job;
    }

    protected function authorizeJobOwnership(Job $job)
    {
        if ($job->recruiter_id !== auth()->id()) {
            throw new AccessDeniedHttpException('Unauthorized to perform this action.');
        }
    }
}

