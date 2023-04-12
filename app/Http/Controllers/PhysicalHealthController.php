<?php

namespace App\Http\Controllers;

use App\Models\PhysicalHealth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhysicalHealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $physical = PhysicalHealth::all();
        return view('questions.physical', ['physical' => $physical]);
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
            return $physical->save() ? redirect('questions/physical')->with('success', 'Added successfully') : redirect('questions/physical')->with('fail', 'Error occured processing your request');
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
            return $physicalHealth->save() ? redirect('questions/physical')->with('success', 'Question Updated successfully') : redirect('questions/physical')->with('fail', 'Error occured processing your request');
        } catch (\Throwable $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhysicalHealth $physicalHealth)
    {
        return $physicalHealth->delete() ? redirect('questions/physical')->with('success', 'Item deleted successfully') : redirect('questions/physical')->with('fail', 'Error occured processing your request');
    }

    public function assessment()
    {
        $data = [
            'physical' => PhysicalHealth::all()->groupBy('question_group')
        ];
        // return response()->json($data, 200);
        return view('assess.physical', $data);
    }
}
