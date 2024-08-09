<?php

namespace App\Http\Controllers;

use App\Models\DeletedUser;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Soft delete the specified user.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function deleteUser(int $userId): JsonResponse
    {

        $user = User::find($userId);
        //$deleted_at = $request->deleted_at;

        $deleteduser = DeletedUser::create([
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'birthdate' => $user->birthdate,       
        ]);


        if ($user) {          

            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
}
