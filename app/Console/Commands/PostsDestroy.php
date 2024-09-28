<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;

class PostsDestroy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:destroy {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Destroy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = (int) $this->argument('id');
        $result = PostHttpClient::make()->login()->destroy($id);
        dd($result);
    }
}
