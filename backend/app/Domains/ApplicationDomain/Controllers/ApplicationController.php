<?php
namespace App\Domains\ApplicationDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function index()
    {
        $applications = Application::with('job')
            ->where('user_id', auth()->id())
            ->get();

        return response()->json($applications);
    }

    public function store(Request $request)
    {
        $validatedData = $this->applicationValidator->validateApplicationCreation($request);

        $application = $this->applicationService->createApplication($validatedData);
        $application->load('user', 'job');

        return response()->json($application, 201);
    }

    public function destroy($id)
    {
        $application = $this->applicationService->getApplicationById($id);

        $this->applicationService->deleteApplication($application);

        return response()->json(['message' => 'Application deleted successfully']);
    }
}
