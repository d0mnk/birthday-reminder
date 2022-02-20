<?php

namespace App\Jobs;

use App\Contact;
use App\Notifications\BirthdayReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendBirthdayReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contacts = Contact::query()->whereRaw('DATE_FORMAT(birthday, "%m-%d") = ?', [Carbon::now()->format('m-d')])->get();

        foreach ($contacts as $contact){
            // Send Notifications
            Log::debug("Sending Notification for {$contact->firstname} {$contact->lastname}");
            Notification::send($contact->user, new BirthdayReminder($contact));
        }
    }
}
