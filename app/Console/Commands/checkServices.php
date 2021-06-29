<?php

namespace App\Console\Commands;

use App\Models\Services;
use App\Notifications\ServiceSuspend;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class checkServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check services';

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


        $carbon = Carbon::now();
        $services = DB::table('services')->get();

        foreach ($services as $service) {
            if (Carbon::parse($service->end_date)->lte($carbon)) {
                $obj = Services::find($service->id);
                if (!$obj->product->price == 0.00) {
                    if ($obj->status !== "suspend" || $obj->status !== "unpaid") {
                        (new \App\Http\Controllers\PleskAPI)->suspendDomain($service->hostname);
                        Notification::send($obj->customer, new ServiceSuspend($service, $obj->product));


                        $obj->status = 'unpaid';
                        $obj->save();
                    }
                }
            }
        }
        return 0;
    }
}
