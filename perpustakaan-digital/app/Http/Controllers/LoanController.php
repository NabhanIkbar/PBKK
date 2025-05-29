<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoanController extends Controller
{
    // Get all loans with user and book data
    public function index(): JsonResponse
    {

        $dataLoan = Loan::all();
        return response()->json($dataLoan, 200);
    }

    public function show($id): JsonResponse
    {
        try {
            $loan = Loan::findOrFail($id);
            return response()->json($loan, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Loan Not Found'], 404);
        }
    }

    // Menambahkan user baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'book_id' => 'required|string|max:255',
        ]);

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ]);


        return response()->json([
            'message' => 'Loan Transaction Was Successfully.',
            'data' => $loan
        ], 201);
    }

      // Mengupdate data user
      public function update(Request $request, $id): JsonResponse
      {
          try {
              $loan = Loan::findOrFail($id);
  
              $request->validate([
                'user_id' => 'sometimes|string|max:255',
                'book_id' => 'sometimes|string|max:255',
            ]);
  
              // Hanya update field yang dikirim
              $data = $request->only(['user_id', 'book_id']);

              $loan->update($data);
              
  
              return response()->json([
                  'message' => $loan->wasChanged()
                      ? 'Loan Transaction Was Updated.'
                      : 'No Changes To This Transaction.',
                  'data' => $loan
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Loan Not Found'], 404);
          }
      }
  
      public function destroy($id): JsonResponse
      {
          try {
              $loan = Loan::findOrFail($id);
              $loan->delete();
  
              return response()->json(['message' => 'Loan Data Successfully Deleted.']);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Loan Not Found.'], 404);
          }
      }
}