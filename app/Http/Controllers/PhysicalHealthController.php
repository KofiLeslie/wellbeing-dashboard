<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealth;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeingEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhysicalHealthController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public $data = [];

    public function index()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        $this->data['physical'] = PhysicalHealth::all();
        return view('questions.physical', $this->data);
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
                    'ageGroup' => ['required'],
                    'qstGroup' => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $physical = new PhysicalHealth();
            $physical->question = $request->question;
            $physical->age_group = $request->ageGroup;
            $physical->question_group = $request->qstGroup;
            return $physical->save() ? redirect()->back()->with('success', 'Added successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhysicalHealth $physicalHealth)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'question' . $physicalHealth->id => ['required'],
                    'ageGroup' . $physicalHealth->id => ['required'],
                    'qstGroup' . $physicalHealth->id => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $physicalHealth->question = $request->input('question' . $physicalHealth->id);
            $physicalHealth->age_group = $request->input('ageGroup' . $physicalHealth->id);
            $physicalHealth->question_group = $request->input('qstGroup' . $physicalHealth->id);
            return $physicalHealth->save() ? redirect()->back()->with('success', 'Question Updated successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhysicalHealth $physicalHealth)
    {
        return $physicalHealth->delete() ? redirect()->back()->with('success', 'Item deleted successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
    }

    public function assessment()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        $questionGrouo = 'endurance';
        $isComplete = false;
        $formArr = ['endurance', 'mobility and balance', 'strength', 'pain'];
        // get user's last evaluation state
        // check if user is a first timer
        $chk = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        if ($chk > 0) {
            $eva = PhysicalHealthEvaluation::whereUser_id(Auth::id())->latest()->first();

            switch (strtolower($eva->question_group)) {
                case 'endurance':
                    $questionGrouo = $formArr[1];
                break;
                case 'mobility and balance':
                    $questionGrouo = $formArr[2];
                break;
                case 'strength':
                    $questionGrouo = $formArr[3];
                break;
                case 'pain':
                    $questionGrouo = null;
                    $isComplete = true;
                break;
            }
        }

        $this->data['title'] = ucwords($questionGrouo);

        $this->data['physical'] = $questionGrouo = null ? [] : PhysicalHealth::whereQuestion_group(strtolower($questionGrouo))->whereAge_group(Auth::user()->age_group)->get();

        if ($isComplete) {
            // get total
            $total = PhysicalHealthEvaluation::whereUser_id(Auth::id())->sum('response');
            if ($total >= 24 && $total <= 96):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Good Physical Health';
            elseif ($total >= 97 && $total <= 168):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Average Physical Health';
            else:
                $this->data['score'] = $total;
                $this->data['msg'] = 'Poor Physical Health';
            endif;
        }
        // return response()->json($data, 200);
        return view('assess.physical', $this->data);
    }
}
