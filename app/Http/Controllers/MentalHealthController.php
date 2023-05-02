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
                $this->data['essay'] = "It seems your mental health and wellbeing is relatively good, however, challenges to our emotional and mental health and wellness occur every day. It is imperative that you always make a conscious effort to keep your mental and emotional health well. Our <a href='#'>resources</a> have been developed to help you target the areas which may not be as robust as they should be. Pay attention to the areas where you fall below 4 on the chart for improvement with our <a href='#'>resources</a>.<br>Why don’t you book a one to one tailored package to maintain and further improve your Psychological Wellbeing and develop the areas where you fall short? <a href='". url('book') ."'>Book a package</a> today at Esther’s Place. ";
            elseif ($total >= 121 && $total <= 130):
                $this->data['score'] = $total;
                $this->data['msg'] = 'Average Psychological Wellbeing';
                $this->data['essay'] = "Your Psychological and emotional wellbeing is average which means that there are key/important areas of your Psychological wellbeing that require improvement. The chart will tell you the areas of your Psychological Wellbeing that are below standard. Pay attention to the areas where you fall below 4 on the chart. These are the areas you need to improve. Access the <a href='#'>resources</a> in the next stage of this app, to improve your Psychological Wellbeing.<br>Poor emotional and psychological health can lead to depression, physical health issues, illnesses and diseases and can affect you relationships at work home and in society. All of these can also them affect your success in life and your quality of life.<br>You can book a one to one, tailored programme that will assist you to improve the areas where you fall short. <a href='". url('book') ."'>Book a package</a> today at Esther’s Place. ";
            else:
                $this->data['score'] = $total;
                $this->data['msg'] = 'Poor Psychological Wellbeing';
                $this->data['essay'] = "It seems your Psychological and Emotional Wellbeing is poor at the moment. You may be going through a particular stressful event or period in your life, or this could be the accumulation of continuous inadequate emotional and psychological health over a long period of time. No matter what, it is important to take steps to improve your emotional and psychological health and wellbeing, so as to maximize your quality of life.<br>Poor emotional and psychological health can affect how you cope with day to day stress and challenges, how you are able to succeed in your relationships and at work, and can even result in poor physical health with symptoms such as pain, fatigue, high blood pressure, weight gain, a weak immune system and being frequently ill.<br>Our <a href='#'>resources</a> are put together to help you take helpful steps to improve your Psychological Wellbeing and your associated health. Take time to go through all the resources, and if you need further help, we are available to assist you get your Psychological Wellbeing back on track with a personalised, tailored and one to one Psychological Wellbeing improvement programme.<br><a href='". url('book') ."'>Book a package</a> today at Esther’s Place.";
            endif;
        }
        // return response()->json($this->data, 200);
        return view('assess.mental', $this->data);
    }
}
