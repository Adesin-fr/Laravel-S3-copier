<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class s3_copy extends Command
{


    protected $signature = 'adesin:s3-copy';
    protected $description = 'Copy the files from source to destination';

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

        // List Files from source :
        $files = Storage::disk("source_s3")->allFiles();
        $file_count =sizeof($files);
        $current_file = 0;

        echo  $file_count." files to copy !\n";
        foreach($files as $file){
            $current_file++;
            $start_time=microtime(true);
            $file_contents =  Storage::disk("source_s3")->get($file);
            $duration = microtime(true) - $start_time;
            if ($duration){
                $transfert_rate = number_format(strlen($file_contents/1024) /$duration,0, ".", ""). "kB/s";
            }else{
                $transfert_rate = "Wow ! Too quick to count !";
            }
            Storage::disk("destination_s3")->put($file, $file_contents);
            echo "Copied $file : $transfert_rate ($current_file / $file_count)\n";
        }

        return Command::SUCCESS;
    }
}
