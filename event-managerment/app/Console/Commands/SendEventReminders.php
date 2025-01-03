<?php

namespace App\Console\Commands;

use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to all event attendes that event start soon!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = \App\Models\Event::with('attendees.user')
        ->whereBetween('start_time',[now(),now()->addDay()])
        ->get();

        $eventsCount = $events->count();
        $eventLabel = Str::plural('event',$eventsCount);

        $this->info('Found'. ' '. $eventsCount.' '.$eventLabel);

        $events->each(fn($event)=> $event->attendees->each(
            fn($attendee) => //$this->info("Notifying the user {$attendee->user->id}")
                    $attendee->user->notify(
                        new EventReminderNotification($event)
                    )
            ) );

        $this->info('Reminder nitifications sent successfully');
    }
}
