<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use Illuminate\Support\Facades\Mail;
use App\Service;
use App\People;
use App\Portfolio;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index(Request $request)
    {

        
        $pages = Page::all();
        $services = Service::where('id', '<', 20)->get();
        $porfolios = Portfolio::get(array('name', 'filter', 'images'));
        $peoples = People::take(3)->get();
        $tags = DB::table('portfolios')->distinct()->lists('filter');

        $menu = [];
        foreach ($pages as $page) {
            $item = array('title' => $page->name, 'alias' => $page->alias);
            array_push($menu, $item);
        }
        $item = array('title'=>'Services','alias'=>'service');
        array_push($menu, $item);
        $item = array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu, $item);
        $item = array('title'=>'Team','alias'=>'team');
        array_push($menu, $item);
        $item = array('title'=>'Contact','alias'=>'contact');
        array_push($menu, $item);

        //dd($pages);


        return view('site.index',array(
                                    'menu'=>$menu,
                                    'pages'=>$pages,
                                    'services'=>$services,
                                    'portfolios'=>$porfolios,
                                    'peoples' => $peoples,
                                    'tags'=>$tags,
        ));

    }
    
    public function sendMail(Request $request) {
        $messages = [
            'required' => "Поле :attribute обязательно к заполнению",
            'email' => "Поле :attribute должно соответствовать email адресу"
        ] ;
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'text'=>'required'
        ], $messages );

        $data = $request->all();

        $result = Mail::send('site.email',['data'=>$data],function ($message) use ($data){
            $mail_admin = env('MAIL_ADMIN');
            $message->from($data['email'],$data['name']);
            $message->to($mail_admin, 'Mr. Admin')->subject('Question');
        });

        if ($result) {
            return redirect()->route('home')->with('status','Email is send');
        }
    }
}
