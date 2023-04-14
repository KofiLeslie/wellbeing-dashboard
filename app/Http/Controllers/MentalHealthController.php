<?php

namespace App\Http\Controllers;

use App\Models\MentalHealth;
use App\Models\MentalHealthEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class MentalHealthController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $physical = MentalHealth::all();
        return view('questions.social', ['physical' => $physical]);
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
                    'question' => ['required'],
                    'qstGroup' => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $physical = new MentalHealth();
            $physical->question = $request->question;
            $physical->question_group = $request->qstGroup;
            return $physical->save() ? redirect()->back()->with('success', 'Added successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MentalHealth $mentalHealth)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'question' . $mentalHealth->id => ['required'],
                    'qstGroup' . $mentalHealth->id => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $mentalHealth->question = $request->input('question' . $mentalHealth->id);
            $mentalHealth->question_group = $request->input('qstGroup' . $mentalHealth->id);
            return $mentalHealth->save() ? redirect()->back()->with('success', 'Question Updated successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MentalHealth $mentalHealth)
    {
        return $mentalHealth->delete() ? redirect()->back()->with('success', 'Item deleted successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
    }

    public function assessment()
    {
        $questionGrouo = 'thoughts';
        $isComplete = false;
        $formArr = ['thoughts', 'feelings', 'somatic'];
        // get user's last evaluation state
        // check if user is a first timer
        $chk = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        if ($chk > 0) {
            $eva = MentalHealthEvaluation::whereUser_id(Auth::id())->latest()->first();
            switch (strtolower($eva->question_group)) {
                case 'thoughts':
                    $questionGrouo = $formArr[1];
                break;
                case 'feelings':
                    $questionGrouo = $formArr[2];
                break;
                case 'somatic':
                    $questionGrouo = null;
                    $isComplete = true;
                break;
            }
        }

        $data = [];
        $data['title'] = ucwords($questionGrouo);

        $data['physical'] = $questionGrouo = null ? [] : MentalHealth::whereQuestion_group(strtolower($questionGrouo))->get();

        if ($isComplete) {
            // get total
            $total = MentalHealthEvaluation::whereUser_id(Auth::id())->sum('response');
            if ($total >= 1 && $total <= 120):
                $data['score'] = $total;
                $data['msg'] = 'Good Psychological Wellbeing';
            elseif ($total >= 121 && $total <= 130):
                $data['score'] = $total;
                $data['msg'] = 'Average Psychological Wellbeing';
            else:
                $data['score'] = $total;
                $data['msg'] = 'Poor Psychological Wellbeing';
            endif;
        }
        // return response()->json($data, 200);
        return view('assess.mental', $data);
    }
}
