<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionsController extends Controller
{
    //
    public function __construct() {
        $this->section = "questions";
    }
    public function index(){
        return view('admin.questions.index')
                ->with([
                    'section' => $this->section,
                    'questions' => Question::all(),
                ]);
    }

    public function create(){
        return view('admin.questions.create')
                ->with([
                    'section' => $this->section,
                ]);
    }

    public function store(Request $request){
        $rules = [
            'question' => 'required',
            'answer' => 'required',
        ];
        $request->validate($rules);
        $question = Question::create($request->all());
        return redirect()->route('questions.show', $question->id);

    }
    public function show($id){
        $question = Question::findOrFail($id);
        return view('admin.questions.show')
                ->with([
                    'section' => $this->section,
                    'question' => $question
                ]);
    }
    public function update($id, Request $request){
        $rules = [
            'question' => 'required',
            'answer' => 'required',
        ];
        $request->validate($rules);
        $question = Question::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('questions.show', $question->id);
    }

    public function destroy($id){
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index');
    }
}
