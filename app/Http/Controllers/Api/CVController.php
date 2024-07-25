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
    
    public function store(CVRequest $request)
    {
        // التحقق من صحة البيانات
        $request->validated();
        
        $user = Auth::user();
        if ($request->name !== $user->name || $request->email !== $user->email) {
            return response()->json(['error' => 'The provided name or email does not match your account.'], 422);
        }
        

        // حفظ الملف
        $filePath = $request->file('file_path')->store('cvs');

        // حفظ البيانات في قاعدة البيانات
        $cv = CV::create([
            'name' => $request->name,
            'email' => $request->email,
            'file_path' => $filePath,
        ]);

        
        return $this->apiResponse(new CVResource($cv),'CV submitted successfully',201);
    }

    
}
