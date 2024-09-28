<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PostsStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Store';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'title1' => 'title',
            'content1' => 'content',
            'profile_id' => 1,
            'category_id' => 1,
            'slug' => 'title'
        ];

        $post = PostHttpClient::make()->login()->store($data);
        dd($post);
    }
}
