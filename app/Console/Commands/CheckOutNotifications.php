<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Hr\ShiftDay;
use App\Notifications\MainNotification;
use App\Services\FCM\FCMService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOutNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-out-notifications';

    /**
     * The console command description.
     * /usr/local/bin/php /home/visiondimensions/public_html/artisan app:check-out-notifications
     * @var string
     */
    protected $description = 'Send notifications to users before check out time';

    /**
     * Execute the console command.
     */
    public function handle()
    { //
        $attendances = Attendance::with(['employee'=>fn($q)=>$q->with('user'),'shift'])->whereNull('check_out')
            ->whereDate('created_at', Carbon::today())->get();

        foreach ($attendances as $attendance){
            $today = ShiftDay::where(["shift_id" => $attendance->shift->id, "day_name" =>  Carbon::now()->format('D')])->first();

            $diffInMinutes = now('Africa/Cairo')->diffInMinutes($today->end_in,false);
            if ($diffInMinutes ==  15){
                $data = [];
                $data['from'] =  config('app.name');
                $data['message'] = 'إقترب وقت اﻹنتهاء من الدوام ,يرجى اﻹستعداد للإنصراف .';
                $attendance->employee->user->notify(new MainNotification($data));
                $fcm = new FCMService();
                $fcm->sendNotification([$attendance->employee?->user?->id],"إقترب وقت اﻹنتهاء من الدوام"
                   , $data['message']
                    , null, null, null, "users");
            }
            $this->info($diffInMinutes);
        }
    }
}
