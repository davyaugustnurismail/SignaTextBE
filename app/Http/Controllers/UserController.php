<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request, $userId)
    {
        // Verifikasi apakah user yang sedang login memiliki akses ke profile ini
        $loggedInUser = Auth::user();

        if ($loggedInUser->id !== (int)$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
            ], 403);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User profile retrieved successfully',
            'data' => $user,
        ], 200);
    }
}