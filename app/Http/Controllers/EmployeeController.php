<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->latest()->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated) {
            $user = User::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone_number' => $validated['phone_number'] ?? null,
                'address' => $validated['address'] ?? null,
                'type' => 'employee',
            ]);

            Employee::query()->create([
                'user_id' => $user->id,
                'job_title' => $validated['job_title'],
                'hire_date' => $validated['hire_date'],
            ]);
        });


        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee){
        $employee->load('user');
        return view('admin.employees.show',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $employee->load('user');
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $employee) {
            $user = $employee->user;
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],

                'phone_number' => $validated['phone_number'] ?? null,
                'address' => $validated['address'] ?? null,


            ];

            if(! empty($validated['password'])){
                $userData['password'] = Hash::make($validated['password']);
            }

            $user?->update($userData);

            $employee->update([

                'job_title' => $validated['job_title'],
                'hire_date' => $validated['hire_date'],
            ]);
        });



        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee){
        DB::transaction(function() use ($employee){
            $user = $employee->user;
            $employee->delete();
            $user?->delete();
        });
        return redirect()->route('admin.employees.index')->with('success','Employee deleted successfully.');
    }

}
