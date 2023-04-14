<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeingEvaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PhysicalHealthEvaluationController extends Controller
{
    public $data = [];

    public function index()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        return view('evaluate.physical', $this->data);
    }
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

    public function evaluate(){
        $eva = PhysicalHealthEvaluation::select('question_group',DB::raw('sum(response) as total_score'))->where('user_id', '=', Auth::id())->groupBy('question_group')->get();
        return response()->json(['data' => $eva], 200);
    }

}
