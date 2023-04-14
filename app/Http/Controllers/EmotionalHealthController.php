<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealth;
use App\Models\EmotionalHealthEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class EmotionalHealthController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $physical = EmotionalHealth::all();
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

            $physical = new EmotionalHealth();
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
    public function update(Request $request, EmotionalHealth $emotionalHealth)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'question' . $emotionalHealth->id => ['required'],
                    'qstGroup' . $emotionalHealth->id => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $emotionalHealth->question = $request->input('question' . $emotionalHealth->id);
            $emotionalHealth->question_group = $request->input('qstGroup' . $emotionalHealth->id);
            return $emotionalHealth->save() ? redirect()->back()->with('success', 'Question Updated successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmotionalHealth $emotionalHealth)
    {
        return $emotionalHealth->delete() ? redirect()->back()->with('success', 'Item deleted successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
    }

    public function assessment()
    {
        $questionGrouo = 'physical health';
        $isComplete = false;
        $formArr = ['physical health', 'mental and emotional health', 'social wellbeing'];
        // get user's last evaluation state
        // check if user is a first timer
        $chk = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();
        if ($chk > 0) {
            $eva = EmotionalHealthEvaluation::whereUser_id(Auth::id())->latest()->first();
            switch (strtolower($eva->question_group)) {
                case 'physical health':
                    $questionGrouo = $formArr[1];
                break;
                case 'mental and emotional health':
                    $questionGrouo = $formArr[2];
                break;
                case 'social wellbeing':
                    $questionGrouo = null;
                    $isComplete = true;
                break;
            }
        }

        $data = [];
        $data['title'] = ucwords($questionGrouo);

        $data['physical'] = $questionGrouo = null ? [] : EmotionalHealth::whereQuestion_group(strtolower($questionGrouo))->get();

        if ($isComplete) {
            // get total
            $total = EmotionalHealthEvaluation::whereUser_id(Auth::id())->sum('response');
            if ($total >= 16 && $total <= 64):
                $data['score'] = $total;
                $data['msg'] = 'Good Overall Health';
            elseif ($total >= 65 && $total <= 112):
                $data['score'] = $total;
                $data['msg'] = 'Average Overall Health';
            else:
                $data['score'] = $total;
                $data['msg'] = 'Poor Overall Health';
            endif;
        }
        // return response()->json($data, 200);
        return view('assess.emotional', $data);
    }
}
