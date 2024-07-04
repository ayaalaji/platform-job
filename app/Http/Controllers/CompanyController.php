<?php
    
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Traits\CompanyManagementTrait;

class CompanyController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['role:Admin', 'permission: الشركات|ادارة الشركات'])->only('index');
        $this->middleware(['role:Admin', 'permission:اضافة شركة'])->only('store');
        $this->middleware(['role:Admin', 'permission:تعديل شركة'])->only('update');
        $this->middleware(['role:Admin', 'permission:حذف شركة'])->only(['destroy','forceDelete']);
        $this->middleware(['role:Admin', 'permission:استعادة شركة'])->only('restore');
   }     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $companies  = Company::all();
            $trachedCompanies = Company::onlyTrashed()->get();
            return view('Admin.company', compact('companies', 'trachedCompanies'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete companies: ' . $th->getMessage());
        }
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    


   ////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
         try{
           $request->validated();

           $company = new Company();
           $company->name = $request->name;
           $company->email = $request->email;
           $company->password = Hash::make($request->password);
           $company->address = $request->address;
           $company->descraption = $request->descraption;
           $company->manager = $request->manager;
           $company->manager_phone = $request->manager_phone;
           $company->save();

           session()->flash('Add', 'Add Susseccfully');
           return redirect()->route('companies.index');
        } catch (\Throwable $th) {
             return redirect()->back()->withInput()->with('error', 'Failed to add company: ' . $th->getMessage());
        }
    }    
    
   
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Company $company )
    {
        try{    
           $request->validated();

            $company->name = $request->name??$company->name;
            $company->email = $request->email??$company->email;
            $company->password = $request->password?? $company->password;
            $company->address = $request->address??$company->address;
            $company->descraption = $request->descraption??$company->descraption;
            $company->manager = $request->manager??$company->manager;
            $company->manager_phone = $request->manager_phone??$company->manager_phone;
            $company->save();

            session()->flash('edit', 'ُEdit Susseccfully');
            return redirect()->route('companies.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Failed to edit company: ' . $th->getMessage());
        }
        
        }                
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
           $company->delete();
            session()->flash('delete', 'Delete Susseccfully');
            return redirect()->route('companies.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete company: ' . $th->getMessage());
        }
    }
    public function restore($id)
    {
        try {
            $company = Company::withTrashed()->findOrFail($id);
            $company->restore();

            return redirect()->route('companies.index')->with('edit', 'Company restored successfully.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete company$company: ' . $th->getMessage());
        }
    }

//========================================================================================================================

    public function forceDelete($id)
    {
        try {
            $company = Company::withTrashed()->findOrFail($id);
            $company->forceDelete();

            return redirect()->route('companies.index')->with('delete', 'Company permanently deleted.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete category: ' . $th->getMessage());
        }
    }
}