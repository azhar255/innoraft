<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyDetails;
use App\Company;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyDetails $request)
    {
         //dd($request->all());

        if($request->hasFile('logo')){
           $file = $request->file('logo');
          $filename = $file->getClientOriginalName();
          $file->storeAs('public/',$filename);

        }
        // $input = $request->all();
        $user = new Company;
        $user->name =  $request->name;
        $user->email = $request->email;
        $user->logo =  $file->getClientOriginalName();
        $user->website = $request->website;
        $user->save();
      
        return back()->with('success', 'Company created successfully.');
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
        $company = Company::find($id);
        return view('company')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyDetails $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
      
        if($request->hasFile('logo')){
            $file = $request->file('logo');
           $filename = $file->getClientOriginalName();
           $file->storeAs('public/',$filename);
           $company->logo = $filename;
         
        }
        $company->save();

        return redirect('/home')->with('success', 'Company Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->status = "Inactive";
        $company->update();
        return back()->with('success', 'Company Deleted successfully.');
    }
}
