<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthEvaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MentalHealthEvaluationController extends Controller
{
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
                    'mh_id' => $explode[0],
                    'response' => $explode[1],
                    'question_group' => $request->title,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

            MentalHealthEvaluation::insert($arr);

            return redirect()->back()->with('success', 'Progress saved');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error has ocured');
        }
    }

    public function evaluate(){
        $eva = MentalHealthEvaluation::select('question_group',DB::raw('sum(response) as total_score'))->where('user_id', '=', Auth::id())->groupBy('question_group')->get();
        return response()->json(['data' => $eva], 200);
    }
}
