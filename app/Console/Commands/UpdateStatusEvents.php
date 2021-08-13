<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Guest;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class UpdateStatusEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateStatusEvent';

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
            $event->update([
                'status' => 'public',
            ]);
        }
    }
}
