<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeing;
use App\Models\SocialWellbeingEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SocialWellbeingController extends Controller
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

        $this->data['physical'] = SocialWellbeing::all();
        return view('questions.social', $this->data);
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

            $physical = new SocialWellbeing();
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
    public function update(Request $request, SocialWellbeing $socialWellbeing)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'question' . $socialWellbeing->id => ['required'],
                    'qstGroup' . $socialWellbeing->id => ['required']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            $socialWellbeing->question = $request->input('question' . $socialWellbeing->id);
            $socialWellbeing->question_group = $request->input('qstGroup' . $socialWellbeing->id);
            return $socialWellbeing->save() ? redirect()->back()->with('success', 'Question Updated successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialWellbeing $socialWellbeing)
    {
        return $socialWellbeing->delete() ? redirect()->back()->with('success', 'Item deleted successfully') : redirect()->back()->with('fail', 'Error occured processing your request');
    }

    public function assessment()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        $questionGrouo = 'social connectedness/integration';
        $isComplete = false;
        $formArr = ['social connectedness/integration', 'autonomy', 'social contribution', 'social acceptance', 'social capital/inclination', 'self-acceptance'];
        // get user's last evaluation state
        // check if user is a first timer
        $chk = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        if ($chk > 0) {
            $eva = SocialWellbeingEvaluation::whereUser_id(Auth::id())->latest()->first();

            switch (strtolower($eva->question_group)) {
                case 'social connectedness/integration':
                    $questionGrouo = $formArr[1];
                break;
                case 'autonomy':
                    $questionGrouo = $formArr[2];
                break;
                case 'social contribution':
                    $questionGrouo = $formArr[3];
                break;
                case 'social acceptance':
                    $questionGrouo = $formArr[4];
                break;
                case 'social capital/inclination':
                    $questionGrouo = $formArr[5];
                break;
                case 'self-acceptance':
                    $questionGrouo = null;
                    $isComplete = true;
                break;
            }
        }

        $this->data['title'] = ucwords($questionGrouo);

        $this->data['physical'] = $questionGrouo = null ? [] : SocialWellbeing::whereQuestion_group(strtolower($questionGrouo))->get();

        if ($isComplete) {
            // get total
            $total = SocialWellbeingEvaluation::whereUser_id(Auth::id())->sum('response');
            if ($total >= 54 && $total <= 180):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Good Social Wellbeing';
            elseif ($total >= 181 && $total <= 360):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Average Social Wellbeing';
            else:
                $this->data['score'] = $total;
                $this->data['msg'] = 'Poor Social Wellbeing';
            endif;
        }
        // return response()->json($this->data, 200);
        return view('assess.social', $this->data);
    }
}
