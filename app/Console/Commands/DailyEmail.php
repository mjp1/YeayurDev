<?php

namespace Yeayurdev\Console\Commands;

use Mail;
use Carbon\Carbon;
use Yeayurdev\Models\User;

use Illuminate\Console\Command;

class DailyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:daily-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create daily email with all posts received by user';

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
     * @return mixed
     */
    public function handle()
    {
        /**
         *  Find all users that have received posts in the past day and send them an email update.
         */

        $users = User::with(['receivedPosts' => function($query) {
            $query->where('created_at', '<=', Carbon::now())->where('created_at', '>', Carbon::now()->subDay());
        }])->get();

        foreach ($users as $user)
        {
            if ($user->receivedPosts->count())
            {
                Mail::send('emails.notifications.weekly', ['user' => $user], function($m) use ($user) {
                    $m->from('contact@yeayur.com', 'Yeayur Post Notification');
                    $m->to($user->email);
                    $m->subject('Your Daily Email Update');
                });
            }
        }
    }
}
