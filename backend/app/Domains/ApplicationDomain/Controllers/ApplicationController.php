<?php

namespace App\Domains\ApplicationDomain\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function index()
    {
        $applications = $this->applicationService->getAllApplications();
        return response()->json($applications);
    }

    public function show($id)
    {
        $application = $this->applicationService->getApplicationById($id);
        return response()->json($application);
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
