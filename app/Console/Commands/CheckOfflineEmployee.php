<?php

namespace App\Console\Commands;

use App\Models\Employee\Offline;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOfflineEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-offline-employee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check offline model for employees to checkout';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $offlines = Offline::with(['attendance'=>fn($q)=>$q->with('shift')])->whereDate('created_at', Carbon::today())->get();

        foreach ($offlines as $offline) {
            if ($offline->attendance->check_out){
                $offline->delete();
            }else{
                $this->info('Offline models checked and Checkout successfully.');
                $minutes = $offline->attendance->shift->offline ?? 1;
                $minutesAgo = Carbon::now()->subMinutes($minutes);
                if ( strtotime($offline->time) <= strtotime($minutesAgo)  ){
                    $offline->attendance->check_out = Carbon::parse( $offline->time)->format('h:i A');
                    $offline->attendance->save();
                    $offline->delete();
                }
            }
        }
        $this->info('Offline models checked and Checkout successfully.');
    }
}
