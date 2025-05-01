<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Validator;

class SmileController extends Controller
{
    public function getSmile(Request $request)
    {
        
        /* Request Validation */
        $validator = Validator::make($request->only(['page', 'per_page']), [
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:50',
        ]);
    
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            
            /* Response 400 Bad Request */
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'error' => $error,
            ], 400);
        }

        
        try {      
            $query = Vaccine::select('id', 'date', 'category', 'amount', 'kode_fasyankes')
                ->with(['fasyankes' => function($query) {
                    $query->select('kode_fasyankes', 'name'); // Pastikan untuk menyertakan 'id' jika ada relasi
                }])
                ->when($request->kode_fasyankes, function ($query, $kode_fasyankes) {
                    return $query->where('kode_fasyankes', $kode_fasyankes);
                })
                ->orderBy('date', 'desc');  

            /* Validation if no data */
            if ($query->get()->count() == 0) {
                return response()->json([], 204);    
            }

            /* Pagination */
            $page = $request->query('page', 1);
            $perPage = $request->input('per_page', 10);
            $data = $query->paginate($perPage, ['*'], 'page', $page);

            /* Response */
            $statusCode = $data->lastPage() <= 1 ? 200 : 206;
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            
            $error = [
                'error' => $e->getMessage()
            ];

            /* Response 500 Internal Server Error */
            return response()->json([
                'code' => 500,
                'message' => 'failed',
                'error' => $error,
            ], 500);

        }

    }
}
