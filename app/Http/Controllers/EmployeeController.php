<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use DB;
use App\Http\Requests\EmployeeRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('employees')->select('employees.id AS id','companies.id AS company_id','companies.name as company_name','employees.fname','employees.lname','employees.email','employees.phone')->join('companies','companies.id','=','employees.company_id')->where('employees.status', 'Active')->paginate(10);
        return view('employee')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyList = Company::where('status','Active')->get(); 
        return view('employee_create_edit')->with('companyList',$companyList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->company_id = $request->company;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect('employee')->with('success','Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyList = Company::where('status','Active')->get(); 
        $company = Employee::find($id);
        return view('employee_create_edit')->with(['companyList'=> $companyList,'company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->company_id = $request->company;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect('employee')->with('success','Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Employee::find($id);
        $company->status = "Inactive";
        $company->update();
        return back()->with('success', 'Employee Deleted successfully.');
    }
}
