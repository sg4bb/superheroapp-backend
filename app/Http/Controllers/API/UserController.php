<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\UpdateUserRequest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return response()->json("Superhero index");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {

            $user = User::findOrFail($id);

            return response()->json(['user' => $user, 200]);

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in UserController.show',
                'error' => $err->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;

            $user->save();

            return response() -> json([
                'User details updated', 200
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in UserController.update',
                'error' => $err->getMessage()
            ]);
        }
    }


}
