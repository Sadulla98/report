<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Aplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AplicationController extends Controller
{

    public function index()
    {
        $applications = auth()->user()->applications()->latest()->paginate(10);
        return view('applications.index')->with([
            'applications' => $applications,
        ]);
    }

    public function store(ApplicationRequest $request)
    {

//        if ($this->checkDate()){
//            return redirect()->back()->with('error', 'You can create only 1 application a day');
//        }

        if ($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs(
                'files',
                $name,
                'local'
            );
        }

        $application = Aplication::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
            'file_name' => $name ?? null,
        ]);

        dispatch(new SendEmailJob($application));

        return redirect()->back()->with('success', __('locale.successfully'));
    }

    protected function checkDate()
    {
        if (auth()->user()->applications()->latest()->first() == null){
            return false;
        }

        $last_application = auth()->user()->applications()->latest()->first();
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($last_app_date == $today){
            return true;
        }
    }
}
