<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public function __construct($post)
    {
        $this->post=$post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->post->photo = 'bigfile/bigfile.zip';
        $this->post->save();
    }
}
