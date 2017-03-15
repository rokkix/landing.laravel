<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Service::create([
           'name'=>'Android',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-android'
        ]);
        \App\Service::create([
            'name'=>'Apple IOS',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-apple'
        ]);
        \App\Service::create([
            'name'=>'Design',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-dropbox'
        ]);
        \App\Service::create([
            'name'=>'Concept',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-html5'
        ]);
        \App\Service::create([
            'name'=>'User Research',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-slack'
        ]);
        \App\Service::create([
            'name'=>'User Experience',
            'text'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text.',
            'icon'=>'fa-users'
        ]);
    }
}
