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
        $file_count = sizeof($files);
        $current_file = 0;
        $total_copied_size = 0;

        echo $file_count . " files to copy !\n";
        $initial_start_time = time();
        foreach ($files as $file) {
            $current_file++;
            $start_time = microtime(true);

            // Get and Store the file
            $file_contents = Storage::disk("source_s3")->get($file);
            $file_size = strlen($file_contents) / 1024;
            Storage::disk("destination_s3")->put($file, $file_contents);

            $duration = microtime(true) - $start_time;
            if ($duration) {
                $transfert_rate = number_format($file_size / $duration, 0, ".", "") . "kB/s";
            } else {
                $transfert_rate = "Wow ! Too quick to count !";
            }

            $total_copied_size += $file_size;
            echo "Copied $file : $transfert_rate ($current_file / $file_count)\n";
        }
        $total_duration = time() - $initial_start_time;
        echo "All files done : $total_copied_size kB copied in $total_duration seconds (". number_format($total_copied_size / $total_duration, 0, ".", "") . "kB/s" .")" ;

        return Command::SUCCESS;
    }
}
