<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
     public function __construct()
    {

        $this->middleware(['permission:إدارة طلبات التوظيف|طلبات التوظيف'])->only('index');
    }
    public function index()
    {
        // جلب جميع بيانات السير الذاتية

        try {
            $cvs = CV::all();
            return view('Admin.cv', compact('cvs'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred  ' . $e->getMessage());
        }
    }
    public function view($id){
        $cv=CV::find($id);
        return view('Admin.viewCv',compact('cv'));
    }
}
