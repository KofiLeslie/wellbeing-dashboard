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
                $this->data['essay'] = "Having a good social wellbeing is important to your wellbeing overall. Your Social Wellbeing is good, and we recommend you keep doing the things you have been doing to keep it that way. Our resources have been developed to help you target the areas which may not be as robust as they should be. Pay attention to the areas where you fall below 4 on the chart for improvement with our <a href='#'>resources</a>.<br>Why don’t you book a one to one tailored package to maintain and further improve your Social Wellbeing and develop the areas where you fall short? <a href='". url('book') ."'>Book a package</a> today at Esther’s Place. ";
            elseif ($total >= 181 && $total <= 360):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Average Social Wellbeing';
                $this->data['essay'] = "Your Social Wellbeing is average which means that there are key/important areas of your social wellbeing that require improvement. The chart will tell you the areas of your Social Wellbeing that are below standard. Pay attention to the areas where you fall below 4 on the chart. These are the areas you need to improve. Good social wellbeing is important to your overall health. It affects your mood, behaviour,actions and physical health. It has been linked to depression and loneliness can increase the risk of heart disease and suicide. Access the <a href='#'>resources</a> in the next stage of this app, to improve your Social Wellbeing.<br>You can also book a one to one, tailored programme that will assist you to improve the areas where you fall short. <a href='". url('book') ."'>Book a package</a> today at Esther’s Place.";
            else:
                $this->data['score'] = $total;
                $this->data['msg'] = 'Poor Social Wellbeing';
                $this->data['essay'] = "It seems your Social Wellbeing is poor at the moment. Poor social wellbeing can affect your emotional and psychological health and also affect your physical health. In fact, it has been shown that social isolation is as harmful to your health as smoking 5 packs of cigarettes a day.<br>Our <a href='#'>resources</a> are put together to help you take helpful steps to improve your Social Wellbeing and your associated health. Take time to go through all the resources, and if you need further help, we are available to assist you get your Social Wellbeing back on track with a personalised, tailored and one to one Social Wellbeing improvement programme.<br><a href='". url('book') ."'>Book a package</a> today at Esther’s Place.";
            endif;
        }
        // return response()->json($this->data, 200);
        return view('assess.social', $this->data);
    }
}
