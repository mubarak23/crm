<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Tasks;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $employees = Employees::where('company_id', $id)->paginate(5);
        //\dd($employees);
        return view('admin.employees')->with('employees', $employees)->with('company_id', $id);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('admin.create_employee')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'first_name'=> 'required|max:90',
            'last_name'=> 'required|max:90',
            'email' => 'required|email',
            'company_id' => 'required',
            'phone_number' => 'required'
        ]);

        //Employees::create($request->all());
        //return admin home page
        $data = $request->all();
        $new_employee = New Employees();
        $new_employee->first_name = $data['first_name'];
        $new_employee->last_name = $data['last_name'];
        $new_employee->company_id = $data['company_id'];
        $new_employee->email = $data['email'];
        $new_employee->phone_number = $data['phone_number'];
        $new_employee->save();
        return \redirect()->route('company.employees', $data['company_id'])->with('flash_message', 'Employee Added Successfully');
    }

    public function createTask(int $id){
        return view('admin.create_task')->with('employee_id', $id);
    }

    public function storeTask(Request $request)
    {
        $data = $request->all();
        $new_task = new Task();
        $new_task->title = $data['title'];
        $new_task->employee_id = $data['employee_id'];
        $new_task->description = $data['description'];
        $new_task->save();
        return \redirect()->route('compaines.list');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees)
    {
        //
        $delete = Employees::delete($id);

    }
}
