<?php

use Illuminate\Database\Seeder;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Portfolio::create([
            'name' => 'App',
            'images' => 'portfolio_pic1.jpg',
            'filter' => 'design'
        ]);
        \App\Portfolio::create([
            'name' => 'Finance App',
            'images' => 'portfolio_pic2.jpg',
            'filter' => 'appleios'
        ]);
        \App\Portfolio::create([
            'name' => 'Concept',
            'images' => 'portfolio_pic3.jpg',
            'filter' => 'design'
        ]);
        \App\Portfolio::create([
            'name' => 'Shopping',
            'images' => 'portfolio_pic4.jpg',
            'filter' => 'android'
        ]);
        \App\Portfolio::create([
            'name' => 'Managment',
            'images' => 'portfolio_pic5.jpg',
            'filter' => 'design'
        ]);
        \App\Portfolio::create([
            'name' => 'iPhone',
            'images' => 'portfolio_pic6.jpg',
            'filter' => 'web'
        ]);
        \App\Portfolio::create([
            'name' => 'Nexus',
            'images' => 'portfolio_pic7.jpg',
            'filter' => 'web'
        ]);
        \App\Portfolio::create([
            'name' => 'Android',
            'images' => 'portfolio_pic8.jpg',
            'filter' => 'android'
        ]);
    }
}
