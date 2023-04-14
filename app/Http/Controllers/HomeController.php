<?php

namespace App\Http\Controllers;

use App\Models\EmotionalHealth;
use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealth;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealth;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeing;
use App\Models\SocialWellbeingEvaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // check if physical evaluation has data
        $chk = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['physical'] = $chk > 0 ? Carbon::parse(PhysicalHealthEvaluation::whereUser_id(Auth::id())->latest('updated_at')->value('updated_at'))->format('M d, Y') : null;

        // check if Social Wellbeing evaluation has data
        $chk = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['social'] = $chk > 0 ? Carbon::parse(SocialWellbeingEvaluation::whereUser_id(Auth::id())->latest('updated_at')->value('updated_at'))->format('M d, Y') : null;

        // check if Psychological Wellbeing evaluation has data
        $chk = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['mental'] = $chk > 0 ? Carbon::parse(MentalHealthEvaluation::whereUser_id(Auth::id())->latest('updated_at')->value('updated_at'))->format('M d, Y') : null;

        // check if Overall Health evaluation has data
        $chk = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['emotional'] = $chk > 0 ? Carbon::parse(EmotionalHealthEvaluation::whereUser_id(Auth::id())->latest('updated_at')->value('updated_at'))->format('M d, Y') : null;

        // get total count of tasks
        $total = PhysicalHealth::whereAge_group(Auth::user()->age_group)->count();
        $total += SocialWellbeing::count();
        $total += MentalHealth::count();
        $total += EmotionalHealth::count();
        $this->data['total_task'] = $total;

        // get total completed tasks
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereAge_group(Auth::user()->age_group)->whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();

        $this->data['total_completed'] = $this->data['has_physical'] + $this->data['has_social'] + $this->data['has_mental'] + $this->data['has_emotional'];
        
        $this->data['total_pending'] = $total - $this->data['total_completed'];

        // return response()->json($this->data, 200);
        return Auth::user()->dob ? view('dashboard.home', $this->data) : view('landing.bio', $this->data);
    }

    public function feed(){
        // get total count of tasks
        $total = PhysicalHealth::count();
        $total += SocialWellbeing::count();
        $total += MentalHealth::count();
        $total += EmotionalHealth::count();
        $this->data['total_task'] = $total;

        // get total completed tasks
        $complete = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $complete += SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $complete += MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $complete += EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['total_completed'] = $complete;

        $this->data['total_pending'] = $total - $complete;

        return response()->json($this->data, 200);
    }
}
