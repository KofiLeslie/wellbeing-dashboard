<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateBio(Request $request)
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
            // return $request->dob;
            if ($valivate->fails()) {
                return redirect()->back()->with('fail', 'Input field(s) cannot be blank');
            //    return redirect('home')->with($status, $msg);
            }

            $user = User::find(Auth::id());
            $user->dob = $request->dob;
            $user->sex = trim(strtolower($request->sex));
            $user->location = trim($request->loc);
            return $user->save() ? redirect('home')->with('success', 'Record updated successfully') : redirect()->back()->with('fail', 'Error occured processing your request');;
        } catch (\Throwable $e) {
            return 123;
            return redirect()->back()->with('success', 'Error occured processing your request');
        }
    }
}
