<?php

namespace App\Jobs;

use App\Mail\ApplicationCreated;
use App\Models\Aplication;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $aplication;
    public function __construct(Aplication $aplication)
    {
        $this->aplication = $aplication;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $manager = User::first();

        Mail::to($manager)->send(new ApplicationCreated($this->aplication));
    }
}
