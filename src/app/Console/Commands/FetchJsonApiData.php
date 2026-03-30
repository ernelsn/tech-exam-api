<?php

namespace App\Console\Commands;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Todo;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCompany;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchJsonApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-json-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from JSONPlaceholder API and store it in the database';

    protected string $baseUrl = 'https://jsonplaceholder.typicode.com';

    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $this->seedUsers();
        $this->seedPosts();
        $this->seedComments();
        $this->seedAlbums();
        $this->seedPhotos();
        $this->seedTodos();
 
        $this->newLine();
        $this->info('Fetching done!');
 
        return self::SUCCESS;
    }

        private function seedUsers(): void
    {
        $users = $this->fetch('users');
 
        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['id' => $data['id']],
                [
                    'name'     => $data['name'],
                    'username' => $data['username'],
                    'email'    => $data['email'],
                    'phone'    => $data['phone'],
                    'website'  => $data['website'],
                    'password' => bcrypt('P@ssword123')
                ]
            );
 
            UserAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'street'   => $data['address']['street'],
                    'suite'    => $data['address']['suite'],
                    'city'     => $data['address']['city'],
                    'zipcode'  => $data['address']['zipcode'],
                    'geo_lat'  => $data['address']['geo']['lat'],
                    'geo_lng'  => $data['address']['geo']['lng'],
                ]
            );
 
            UserCompany::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name'         => $data['company']['name'],
                    'catch_phrase' => $data['company']['catchPhrase'],
                    'bs'           => $data['company']['bs'],
                ]
            );
        }
 
        $this->info("  users: " . count($users) . " records saved");
    }
 
    private function seedPosts(): void
    {
        $posts = $this->fetch('posts');
 
        foreach ($posts as $data) {
            Post::updateOrCreate(
                ['id' => $data['id']],
                [
                    'user_id' => $data['userId'],
                    'title'   => $data['title'],
                    'body'    => $data['body'],
                ]
            );
        }
 
        $this->info("  posts: " . count($posts) . " records saved");
    }
 
    private function seedComments(): void
    {
        $comments = $this->fetch('comments');
 
        foreach ($comments as $data) {
            Comment::updateOrCreate(
                ['id' => $data['id']],
                [
                    'post_id' => $data['postId'],
                    'name'    => $data['name'],
                    'email'   => $data['email'],
                    'body'    => $data['body'],
                ]
            );
        }
 
        $this->info("  comments: " . count($comments) . " records saved");
    }
 
    private function seedAlbums(): void
    {
        $albums = $this->fetch('albums');
 
        foreach ($albums as $data) {
            Album::updateOrCreate(
                ['id' => $data['id']],
                [
                    'user_id' => $data['userId'],
                    'title'   => $data['title'],
                ]
            );
        }
 
        $this->info("  albums: " . count($albums) . " records saved");
    }
 
    private function seedPhotos(): void
    {
        $photos = $this->fetch('photos');
 
        foreach ($photos as $data) {
            Photo::updateOrCreate(
                ['id' => $data['id']],
                [
                    'album_id'      => $data['albumId'],
                    'title'         => $data['title'],
                    'url'           => $data['url'],
                    'thumbnail_url' => $data['thumbnailUrl'],
                ]
            );
        }
 
        $this->info("  photos: " . count($photos) . " records saved");
    }
 
    private function seedTodos(): void
    {
        $todos = $this->fetch('todos');
 
        foreach ($todos as $data) {
            Todo::updateOrCreate(
                ['id' => $data['id']],
                [
                    'user_id'   => $data['userId'],
                    'title'     => $data['title'],
                    'completed' => $data['completed'],
                ]
            );
        }
 
        $this->info("  todos: " . count($todos) . " records saved");
    }
 
    private function fetch(string $resource): array
    {
        $this->line("Fetching {$resource}...");
 
        $response = Http::timeout(30)
            ->acceptJson()
            ->get("{$this->baseUrl}/{$resource}");
 
        if ($response->failed()) {
            $this->error("Failed to fetch {$resource} (HTTP {$response->status()}). Skipping.");
            return [];
        }
 
        return $response->json();
    }
}
