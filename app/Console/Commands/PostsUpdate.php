<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PostsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = 20;
        $data = [
           'title1' => 'title123',
           'content' => 'content123',
           'profile_id' => 1,
           'category_id' => 1,
           'slug' => 'title11'
        ];

        $post = PostHttpClient::make()->login()->update($id, $data);
        dd($post);
    }
}
