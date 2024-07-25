<?php 

namespace App\Http\Traits;

trait CommentResponseTrait 
{
    public function commentResponse($data,$message,$status){
        $array = [
            'data'=>$data,
            'message'=>$message,
        ];

        return response()->json($array,$status);
    }
    public function apiDelete($message,$status){
        return response()->json($message,$status);
    }  
    public function apiResponse($message,$status){
        return response()->json($message,$status);
    }  
}