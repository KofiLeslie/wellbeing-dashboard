<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateBio(User $user, Request $request)
    {
        try {
            $valivate = Validator::make(
                $request->all(),
                [
                    'dob' => ['required'],
                    'sex' => ['required', 'string', 'max:1'],
                    'loc' => ['required', 'string', 'max:50']
                ]
            );

            if ($valivate->fails()) {
                return redirect()->back()->with($valivate->fails());
            }

            $user->dob = $request->dob;
            $user->sex = trim(strtolower($request->sex));
            $user->location = trim($request->loc);
            return $user->save() ? view('dashboard.home') : redirect()->back()->with('error', 'Error occured processing your request');;
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error occured processing your request');
        }
    }
}
