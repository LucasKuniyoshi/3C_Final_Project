<?php
namespace App\Domains\CompanyDomain\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Domains\CompanyDomain\Services\Contracts\CompanyServiceInterface;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return response()->json($this->companyService->getAllCompanies());
    }

    public function show($id)
    {
        return response()->json($this->companyService->getCompanyById($id));
    }

    public function store(Request $request)
    {
        $data = Request::all();
        return response()->json($this->companyService->createCompany($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json($this->companyService->updateCompany($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->companyService->deleteCompany($id));
    }
}
