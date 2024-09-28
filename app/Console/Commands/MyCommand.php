<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'My command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd(PostHttpClient::login());
    }
}
