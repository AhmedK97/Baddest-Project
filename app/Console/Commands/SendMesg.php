<?php

namespace App\Console\Commands;

use App\Models\msg;
use App\Models\Project;
use App\Models\Sitting;
use Illuminate\Console\Command;

class SendMesg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendMesg';

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
        $sitting = Sitting::get()->first();

        if ($sitting->value == 1) {

            $projects = Project::whereDate('nextdate', now()->format('Y-m-d'))->get();


            $msgs = msg::get();
            foreach ($msgs as $msg) {
                // echo now()->format('d') . '/';
                if ($msg->created_at->format('d') != now()->format('d')) {
                    msg::where('id', $msg->id)->delete();
                }
            }
            // dd($msg);
            foreach ($projects as $project) {
                // dd($project->name);
                $msg = msg::where('mobile', $project->phone)->count();
                // dd($msg);
                if (empty($msg)) {
                    $mesg =
                        ' مركز ايليت للاسنان أ \ ،'
                        .
                        $project->name
                        .
                        ' نذكر سيادتكم بان ميعاد الجلسه اليوم الساعه '
                        .
                        date("h:i A", strtotime($project->nextdate))
                        .
                        '، يرجى الالتزام بالميعاد ،وفي حاله الاعتذار يرجى الاتصال قبل الميعاد بساعتين';

                    msg::create(['msg' => urlencode($mesg), 'project_id' => $project->id, 'mobile' => $project->phone]);
                }
            }

            foreach ($msgs as $msg) {
                // dd($msg->created_at->format('H') +3);

                if (($msg->status == 0) && (now()->format('H') >= 9)) {
                    // dd(now()->format('H'));
                    file_get_contents("http://sms.elitedentalcenterqena.com/appsms/index.php?msg=" . $msg->msg . "&number=" . $msg->mobile);
                    msg::where('status', 0)->where('id', $msg->id)->update(['status' => 1]);
                    // sleep(10);
                    die();
                }
            }
        }
    }
}
