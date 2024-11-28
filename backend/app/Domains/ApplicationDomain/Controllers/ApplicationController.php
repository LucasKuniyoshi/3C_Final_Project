<?php

namespace App\Domains\ApplicationDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\JobDomain\Models\Job;
use App\Domains\ApplicationDomain\Models\Application;
use App\Domains\ApplicationDomain\Validators\ApplicationValidator;
use App\Domains\ApplicationDomain\Services\Contracts\ApplicationServiceInterface;

class ApplicationController extends Controller
{
    protected $applicationService;
    protected $applicationValidator;

    public function __construct(ApplicationServiceInterface $applicationService, ApplicationValidator $applicationValidator)
    {
        $this->applicationService = $applicationService;
        $this->applicationValidator = $applicationValidator;
    }

    public function listApplicantsByJob(Request $request, $id)
    {
        $job = Job::where('id', $id)
                  ->where('recruiter_id', auth()->id())
                  ->firstOrFail();

        $applications = Application::where('job_id', $job->id)
                                   ->with('candidate')
                                   ->get();

        return response()->json($applications);
    }
    public function index()
    {
        $applications = $this->applicationService->getAllApplications();

        return response()->json($applications->map(function ($application) {
            return [
                'id' => $application->id,
                'user_id' => $application->user_id,
                'job_id' => $application->job_id,
                'name' => $application->name,
                'recruiter_id' => $application->recruiter_id,
                'additional_info' => $application->additional_info,
                'resume_path' => $application->resume_path,
                'created_at' => $application->created_at,
                'updated_at' => $application->updated_at,
            ];
        }));
    }

    public function show($id)
    {
        $application = $this->applicationService->getApplicationById($id);

        return response()->json([
            'id' => $application->id,
            'user_id' => $application->user_id,
            'job_id' => $application->job_id,
            'name' => $application->name,
            'recruiter_id' => $application->recruiter_id,
            'additional_info' => $application->additional_info,
            'resume_path' => $application->resume_path,
            'created_at' => $application->created_at,
            'updated_at' => $application->updated_at,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->applicationValidator->validateApplicationCreation($request);

        $application = $this->applicationService->createApplication($validatedData);

        return response()->json($application, 201);
    }

    public function update(Request $request, $id)
    {
        $application = $this->applicationService->getApplicationById($id);

        $validatedData = $this->applicationValidator->validateApplicationUpdate($request);

        $updatedApplication = $this->applicationService->updateApplication($application, $validatedData);

        return response()->json($updatedApplication);
    }

    public function destroy($id)
    {
        $application = $this->applicationService->getApplicationById($id);

        $this->applicationService->deleteApplication($application);

        return response()->json(['message' => 'Application deleted successfully']);
    }
}
