<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\API\V1\EmployeesRequest;
use App\Http\Requests\API\V1\EmployeeRequest;
use App\Http\Requests\API\V1\CreateEmployeeRequest;
use App\Http\Requests\API\V1\DeleteEmployeeRequest;
use App\Http\Requests\API\V1\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\API\V1\EmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends Controller
{

    public function index(EmployeesRequest $request)
    {
        return EmployeeResource::collection(Employee::paginate());
    }

    public function show(EmployeeRequest $request, $id)
    {
        return new EmployeeResource(Employee::find($id));
    }

    public function store(CreateEmployeeRequest $request)
    {
        return new EmployeeResource(Employee::create($request->validated([
            'name',
            'last_name',
            'gender',
            'phone',
            'email',
            'company_id',
        ])));
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        return new EmployeeResource(Employee::updateOrCreate([
            'id' => $request['employee'],
        ],
            $request->validated([
                'name',
                'last_name',
                'gender',
                'phone',
                'email',
            ]))
        );
    }

    public function destroy(DeleteEmployeeRequest $request, $id)
    {
        Employee::destroy($id);
        return response()->json([
            'message' => 'success',
        ]);
    }
}
