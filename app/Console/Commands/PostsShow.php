<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;

class PostsShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:show {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Show';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = (int) $this->argument('id');
        $post = PostHttpClient::make()->show($id);
        dd($post);
    }
}
