<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    // Get all books with authors
    public function index(): JsonResponse
    {

        $dataBook = Book::all();
        return response()->json($dataBook, 200);
    }

    public function show($id): JsonResponse
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book Not Found'], 404);
        }
    }

    // Menambahkan user baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'publisher' => 'required|string',
            'year_published' => 'required|string',
            'stock' => 'required|integer|max:225'
        ]);

        $book = Book::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'year_published' => $request ->year_published,
            'stock' => $request ->stock
        ]);


        return response()->json([
            'message' => 'The Book Has Been Added Successfully.',
            'data' => $book
        ], 201);
    }

      // Mengupdate data user
      public function update(Request $request, $id): JsonResponse
      {
          try {
              $book = book::findOrFail($id);
  
              $request->validate([
                'title' => 'sometimes|string|max:255',
                'isbn' => 'sometimes|string|max:255',
                'publisher' => 'sometimes|string',
                'year_published' => 'sometimes|string',
                'stock' => 'sometimes|integer|max:225'
            ]);
  
              // Hanya update field yang dikirim
              $data = $request->only(['title', 'isbn', 'publisher', 'year_publisher', 'stock']);

              $book->update($data);
              
  
              return response()->json([
                  'message' => $book->wasChanged()
                      ? 'Book Successfully Updated.'
                      : 'No Changes to Book Data.',
                  'data' => $book
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Book Not Found'], 404);
          }
      }
  
      public function destroy($id): JsonResponse
      {
          try {
              $book = Book::findOrFail($id);
              $book->delete();
  
              return response()->json(['message' => 'The Book Has Been Successfully Deleted.']);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Book Not Found.'], 404);
          }
      }
}