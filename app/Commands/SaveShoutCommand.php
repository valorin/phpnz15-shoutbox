<?php
namespace App\Commands;

use App\Shout;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveShoutCommand extends Command implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var string
     */
    public $message;

    /**
     * Create a new command instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = str_limit($message, 500, '...');
    }

    /**
     * Execute the command.
     */
    public function handle()
    {
        Shout::create([
            'message' => $this->message,
        ]);
    }
}
