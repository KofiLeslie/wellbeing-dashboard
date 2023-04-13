<?php

namespace App\Http\Controllers;

use App\Models\PhysicalHealthEvaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhysicalHealthEvaluationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'datax' => ['required', 'min:1'],
                    'title' => ['required'],
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $data = json_decode($request->datax);
            $arr = [];

            if(count($data) == 0){
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            // loop array and extract values
            foreach ($data as $dat) {
                $explode = explode('@@', $dat);
                $arr[] = [
                    'user_id' => Auth::id(),
                    'ph_id' => $explode[0],
                    'response' => $explode[1],
                    'question_group' => $request->title,
                    'age_group' => Auth::user()->age_group,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

            PhysicalHealthEvaluation::insert($arr);

            return redirect()->back()->with('success', 'Progress saved');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error has ocured');
        }
    }

}
