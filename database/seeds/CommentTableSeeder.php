<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @var App\Models\Comment
     */
    protected $comment;

    /**
     * @var App\Models\Wiki
     */
    protected $wiki;

	/**
     * @param User $user App\Models\User
     */
    function __construct(User $user, Comment $comment, Wiki $wiki) {
        $this->user 	= $user;
        $this->comment 	= $comment;
        $this->wiki 	= $wiki;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();
        $users = $this->user->pluck('id')->all();
        $wikis = $this->wiki->pluck('id')->all();
        for ($i = 0; $i < 50; $i++) {
            $this->comment->create([
                'page_id'    	=>  $faker->randomElement($wikis),
                'content' 		=>  $faker->paragraph(1, true),
                'user_id' 		=>  $faker->randomElement($users),
            ]);
        }
    }
}
