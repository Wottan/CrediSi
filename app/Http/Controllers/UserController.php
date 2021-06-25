<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends ModelController
{
    protected function getModel()
    {
        return User::class;
    }

    protected function with(): array
    {
        return ['labels'];
    }

    public function sync(Request $request, User $user)
    {
        try {
            $user->labels()->sync($request->all());
            return response()->json($user->load('labels'));
        } catch (\Throwable $th) {
            return response()->json($th->errorInfo, 400);
        }
    }

    public function returnLabels(User $user)
    {
        //This lines give the relations with labels (user.labels)
        $labels = $user->labels->makeHidden(['pivot', 'created_at', 'updated_at']);
        return response()->json($labels);
    }
}
