<?php

namespace App\Http\Controllers;

use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookAuthorController extends Controller
{

    public function index(): JsonResponse
    {

        $bookAuthor = BookAuthor::all();
        return response()->json($bookAuthor, 200);
    }

    public function show($id): JsonResponse
    {
        try {
            $bookAuthor = BookAuthor::findOrFail($id);
            return response()->json($bookAuthor, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'The Author of The Book was Not Found'], 404);
        }
    }

     public function store(Request $bookAuthor): JsonResponse
    {
        $bookAuthor->validate([
            'book_id' => 'required|string|max:255',
            'author_id' => 'required|string|max:255',
        ]);

        $bookAuthor = BookAuthor::create([
            'book_id' => $bookAuthor->book_id,
            'author_id' => $bookAuthor->author_id,
        ]);


        return response()->json([
            'message' => 'Book Author Successfully Added.',
            'data' => $bookAuthor
        ], 201);
    }

   public function update(Request $request, $id): JsonResponse
      {
          try {
              $bookAuthor = BookAuthor::findOrFail($id);
  
              $request->validate([
                'book_id' => 'sometimes|string|max:255',
                'author_id' => 'sometimes|string|max:255',
            ]);
  
              // Hanya update field yang dikirim
              $data = $request->only(['book_id', 'author_id']);

              $bookAuthor->update($data);
              
  
              return response()->json([
                  'message' => $bookAuthor->wasChanged()
                      ? 'Book Author Successfully Updated.'
                      : 'No Changes to Book Author Data.',
                  'data' => $bookAuthor
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Book Author Not Found'], 404);
          }
      }
  
      public function destroy($id): JsonResponse
      {
          try {
              $bookAuthor = BookAuthor::findOrFail($id);
              $bookAuthor->delete();
  
              return response()->json(['message' => 'Book Author Successfully Deleted.']);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Book Author Not Found.'], 404);
          }
      }
}