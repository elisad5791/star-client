<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;

class PostsIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Index';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filter = ['title' => 'alias'];
        $posts = PostHttpClient::make()->index($filter);
        dd($posts);
    }
}
