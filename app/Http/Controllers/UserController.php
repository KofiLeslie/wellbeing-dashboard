<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeingEvaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $data = [];

    public function index()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        return view('profile.list', $this->data);
    }

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
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            // get age from date of birth
            $age = \Carbon\Carbon::parse($request->dob)->age;

            $age_group = $age >= 60 ? 'OLD' : 'YOUNG';

            $user = User::find(Auth::id());
            $user->dob = $request->dob;
            $user->sex = trim(strtolower($request->sex));
            $user->location = trim($request->loc);
            $user->age_group = $age_group;

            return $user->save() ? redirect('home')->with('success', 'Record updated successfully') : redirect()->back()->with('error', 'Error occured processing your request');
        } catch (\Throwable $e) {

            return redirect()->back()->with('error', 'Error occured processing your request');
        }
    }

    public function updateProfile(Request $request){
        try {
            $valivate = Validator::make(
                $request->all(),
                [
                    'name' => ['required'],
                    'sex' => ['required', 'string', 'max:1'],
                    'loc' => ['required', 'string', 'max:50']
                ]
            );
            // return $request->dob;
            if ($valivate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->sex = trim(strtolower($request->sex));
            $user->location = trim($request->loc);

            return $user->save() ? redirect()->back()->with('success', 'Profile updated successfully') : redirect()->back()->with('error', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error occured processing your request');
        }
    }
}
