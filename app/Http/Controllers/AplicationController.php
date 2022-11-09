<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use Illuminate\Http\Request;

class AplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'file|mimes:jpg,png,pdf',
        ]);

        if ($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();

            $path = $request->file('file')->storeAs(
                'files',
                $name,
                'public'
            );
        }

        $application = Aplication::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        return redirect()->back();
    }
}
