<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\CompaniesRequest;
use App\Http\Requests\API\V1\CompanyRequest;
use App\Http\Requests\API\V1\CreateCompanyRequest;
use App\Http\Requests\API\V1\DeleteCompanyRequest;
use App\Http\Requests\API\V1\UpdateCompanyRequest;
use App\Http\Resources\API\V1\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{

    /**
     * Lists companies.
     *
     * @param CompaniesRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(CompaniesRequest $request)
    {
        return CompanyResource::collection(Company::paginate());
    }

    /**
     * Show company by ID.
     *
     * @param CompanyRequest $request
     * @param $id
     * @return CompanyResource
     */
    public function show(CompanyRequest $request, $id)
    {
        return new CompanyResource(Company::find($id));
    }

    /**
     * Creates a new company.
     *
     * @param CreateCompanyRequest $request
     * @return CompanyResource
     */
    public function store(CreateCompanyRequest $request)
    {
        return new CompanyResource(Company::create($request->validated([
            'name',
            'email',
            'website',
        ])));
    }

    /**
     * Updates a company by ID.
     *
     * @param UpdateCompanyRequest $request
     * @param $id
     * @return CompanyResource
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        return new CompanyResource(Company::updateOrCreate([
            'id' => $request['company'],
        ],
            $request->validated([
                'name',
                'email',
                'logo',
                'website',
            ]))
        );
    }

    /**
     * Deletes a company.
     *
     * @param DeleteCompanyRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function destroy(DeleteCompanyRequest $request, $id)
    {
        Company::destroy($id);
        return response()->json([
            'message' => 'success',
        ]);
    }
}
