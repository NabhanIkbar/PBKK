<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        return User::all();
    }

    // Create new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        return User::create($validated);
    }

    // Get single user
    public function show(User $user)
    {
        return $user;
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:50',
            'email' => 'sometimes|email|unique:users,email',
            'password' => 'sometimes|string|min:8',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    // Delete user
   public function destroy($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User Has Been Successfully Deleted.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User Not Found.'], 404);
        }
    }
}