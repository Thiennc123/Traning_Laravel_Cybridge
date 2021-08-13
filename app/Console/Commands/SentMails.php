<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Event;
use App\Mail\Gmail;
use App\Mail\UserMail;
use Carbon\Carbon;

class SentMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sentMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $events = Event::all();

        foreach ($events as $event) {



            if ($event->date_end == (Carbon::now()->addDays(3))) {

                Mail::to($event->guests->email)->send(new UserMail());
            }
        }
    }
}
