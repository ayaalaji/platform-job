<?php

namespace App\Http\Controllers\Api;

use App\Models\CV;
use Illuminate\Http\Request;
use App\Http\Requests\CVRequest;
use App\Http\Resources\CVResource;
use App\Http\Controllers\Controller;
use App\Http\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CVController extends Controller
{ 
    use ApiResponseTrait;

    public function index($id=null)
{
    try {
        $user = Auth::user();
        
        // التحقق مما إذا كان المستخدم مدير
        if (!in_array('Manager', $user->role)) {
            return $this->apiResponse(null, 'Unauthorized', 403);
        }

        // الحصول على معرف الشركة التي يعمل بها المدير
        $companyId = $user->company_id;


        // الحصول على السيفيات المخصصة للشركة
        if ($id) {
            // الحصول على السيفي الذي يتوافق مع المعرف الممرر والمخصص للشركة
            $cv = CV::where('company_id', $companyId)->where('id', $id)->first();

            // التحقق مما إذا كان السيفي موجوداً
            if (!$cv) {
                return $this->apiResponse(null, 'CV not found', 404);
            }

            return $this->apiResponse(new CVResource($cv), 'CV details', 200);
        } else {
            // الحصول على جميع السيفيات المخصصة للشركة
            $cvs = CV::where('company_id', $companyId)->get();
            return $this->apiResponse(CVResource::collection($cvs), 'All CVs', 200);
        }} catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}
    
    public function store(CVRequest $request)
    {
        // التحقق من صحة البيانات
        $request->validated();
        
        $user = Auth::user();
        if ($request->name !== $user->name || $request->email !== $user->email) {
            return response()->json(['error' => 'The provided name or email does not match your account.'], 422);
        }
        

        
        $cv = new CV();
        $file_path = $request->file_path;
        $fileName = time() . '.' . $file_path->getClientOriginalExtension();
        $request->file_path->move('assets', $fileName);

        $cv->file_path = $fileName;
        $cv->name = $request->name;
        $cv->email = $request->email;
        $cv->company_id = $request->company_id;
        $cv->save();

return $this->apiResponse(new CVResource($cv), 'CV submitted successfully', 201);
    }
    public function destroy($id)
{
    try {
        $user = Auth::user();

        // التحقق مما إذا كان المستخدم مدير
        if (!in_array('Manager', $user->role)) {
            return $this->apiResponse(null, 'Unauthorized', 403);
        }

        // الحصول على معرف الشركة التي يعمل بها المدير
        $companyId = $user->company_id;

        // الحصول على السيفي الذي يتوافق مع المعرف الممرر والمخصص للشركة
        $cv = CV::where('company_id', $companyId)->where('id', $id)->first();

        // التحقق مما إذا كان السيفي موجوداً
        if (!$cv) {
            return $this->apiResponse(null, 'CV not found', 404);
        }

        // حذف السيفي
        $cv->delete();

        return $this->apiResponse(null, 'CV deleted successfully', 200);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


    
}
