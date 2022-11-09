<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        return redirect('dashboard');
    }

    public function dashboard()
    {
        $applications = Aplication::latest()->paginate(3);
        return view('dashboard')->with([
            'applications' => $applications,
        ]);
    }
}
