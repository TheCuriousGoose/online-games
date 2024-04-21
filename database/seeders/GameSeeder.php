<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'title' => 'Pong',
            'description' => 'The programmers favourite response to ping! Give this classic a shot',
            'image' => '/imgs/pong.webp',
            'cost' => 1
        ]);

        Game::create([
            'title' => 'Tetris',
            'description' => 'A good old classic that you will rage at!',
            'image' => '/imgs/tetris.webp',
            'cost' => 1
        ]);

        Game::create([
            'title' => 'Whack-a-mole',
            'description' => 'Do you have aggression problems? Well this is the perfect chance to take it out on some moles!',
            'image' => '/imgs/whack-a-mole.webp',
            'cost' => 3
        ]);

        Game::create([
            'title' => 'Snake',
            'description' => 'Those apples must be so tasty! But can you catch them all?',
            'image' => '/imgs/snake.webp',
            'cost' => 2
        ]);

        Game::create([
            'title' => 'Jumper',
            'description' => 'Are you going to be the next olympic champion? Probably not so you can at least try it here!',
            'image' => '/imgs/jumper.webp',
            'cost' => 1
        ]);

        Game::create([
            'title' => 'Race',
            'description' => 'Are you Lighting Mcqueen or maybe even the next Max Verstappen? Show you racing skills here!',
            'image' => '/imgs/race.webp',
            'cost' => 3
        ]);

        Game::create([
            'title' => 'Penguin Danger',
            'description' => 'Gotta go fast! Wait wrong game well anyways just try to not get caught!',
            'image' => '/imgs/penguin-danger.webp',
            'cost' => 1
        ]);

        Game::create([
            'title' => 'Tower of Hantoi',
            'description' => 'You\'ll need your brain for this. But I believe in your 2 brain cells',
            'image' => '/imgs/tower-of-hantoi.webp',
            'cost' => 2
        ]);
    }
}
