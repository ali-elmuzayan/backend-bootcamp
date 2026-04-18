<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    // Success response with data
    protected function successResponse(
        mixed $data = null,
        string $message = 'Success', 
        int $status = 200, 
        array $meta = [], 
    ) : JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message, 
            'data' => $data, 
            'errors' => null, 
            'meta' => array_merge([
                'timestamp' => now()->toISOString(),
            ], $meta)
        ], $status);
    }




    // Error response with validation errors
    protected function errorResponse(
        string $message = 'Error', 
        int $status = 400, 
        array $errors = [], 
        string $code = 'GENERAL_ERROR',
        array $meta = [],
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'code' => $code,
            'meta' => array_merge([
                'timestamp' => now()->toISOString()
            ], $meta)
        ], $status);
    }
}


/*
    The Schema for the ApiResponse trait is as follows: 

    {
        "success": true,
        "message": "Fetched successfully",
        "data": {},
        "errors": null,
        "meta": {}
    }

    {
        "success": false,
        "message": "Validation failed",
        "data": null,
        "errors": {},
        "meta": {}
    }
*/