<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\EmotionalHealthEvaluation;
use App\Models\MentalHealthEvaluation;
use App\Models\PhysicalHealthEvaluation;
use App\Models\SocialWellbeingEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public $data = [];
    private $storage_path;

    public function __construct()
    {
        $this->storage_path = public_path('feedback/');
    }

    public function index()
    {
        $this->data['has_physical'] = PhysicalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_social'] = SocialWellbeingEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_mental'] = MentalHealthEvaluation::whereUser_id(Auth::id())->count();
        $this->data['has_emotional'] = EmotionalHealthEvaluation::whereUser_id(Auth::id())->count();
        // return $this->statusCode(200, 'shit', $this->data);
        return view('feedback.list', $this->data);
    }

    public function store(Request $request)
    {
        $path = $mimeType = null;
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'subject' => ['required'],
                    'desc' => ['required'],
                    'media' => ['nullable', 'file']
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->with('error', 'Input field(s) cannot be blank');
            }

            if ($request->has('media')) {
                $acceptTypes = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
                $file = $request->file('media');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file_type = $file->getClientOriginalExtension();
                $mimeType = $file->getMimeType();
                $hasMatch = false;

                foreach ($acceptTypes as $types) {
                    ($types == $file_type) ? $hasMatch = true : '';
                }

                if (!$hasMatch) {
                    return redirect()->back()->with('error', 'Invalid file type. Acceptable types are [' . implode(', ', $acceptTypes) . ']');
                }

                $path = $file_name;
                $file->move($this->storage_path, $file_name);
            }

            $feedback = new Feedback();
            $feedback->user_id = Auth::id();
            $feedback->subject = $request->subject;
            $feedback->description = $request->desc;
            $feedback->path = $path;
            $feedback->mime_type = $mimeType;
            return $feedback->save() ? redirect()->back()->with('success', 'Feedback sent successfully') : redirect()->back()->with('error', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }
}
