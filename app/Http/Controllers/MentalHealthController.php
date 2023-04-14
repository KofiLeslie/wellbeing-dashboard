<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealth;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeingEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class MentalHealthController extends Controller
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

        $this->data['physical'] = MentalHealth::all();
        return view('questions.mental', $this->data);
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
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

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

        $this->data['title'] = ucwords($questionGrouo);

        $this->data['physical'] = $questionGrouo = null ? [] : MentalHealth::whereQuestion_group(strtolower($questionGrouo))->get();

        if ($isComplete) {
            // get total
            $total = MentalHealthEvaluation::whereUser_id(Auth::id())->sum('response');
            if ($total >= 1 && $total <= 120):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Good Psychological Wellbeing';
            elseif ($total >= 121 && $total <= 130):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Average Psychological Wellbeing';
            else:
                $this->data['score'] = $total;
                $this->data['msg'] = 'Poor Psychological Wellbeing';
            endif;
        }
        // return response()->json($this->data, 200);
        return view('assess.mental', $this->data);
    }
}
