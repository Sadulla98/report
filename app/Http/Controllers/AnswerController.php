<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
    public function __construct()
    {
//        $this->middleware('role:manager');
    }

    public function create(Aplication $aplication)
    {
//        if (! Gate::allows('answer-application', auth()->user())) {
//            abort(403);
//        }

        return view('answers.create', ['aplication' => $aplication]);
    }

    public function store(Aplication $aplication, Request $request)
    {
//        if (! Gate::allows('answer-application', auth()->user())) {
//            abort(403);
//        }

        $request->validate(['body' => 'required']);

        $aplication->answer()->create([
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard');
    }
}
