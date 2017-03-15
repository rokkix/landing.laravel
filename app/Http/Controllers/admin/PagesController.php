<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    
    public function index() {
        if(view()->exists('admin.pages')) {
            $pages = Page::all();
            $data = [
                'title' => 'Страницы',
                'pages' => $pages
            ];

            return view('admin.pages', $data);
        }
        abort(404);
    }

    public function create(Page $page, Request $request) {

        if(view()->exists('admin.pages_add')) {
            $data = [
                'title' => 'Новая страница'
            ];
            return view('admin.pages_add',$data);
        }
        abort(404);
     
    }
    
    public function store(Request $request) {
        
        $input = $request->except('_token');

        $messages = [
            'required'=>'Поле :attribute обязатеьно к заполнению',
            'unique'=>'Поле :attribute должно быть уникальным'
        ];

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'alias' => 'required|unique:pages|max:255',
            'text' => 'required'
        ], $messages);
        if($validator->fails()) {

            return   redirect()->route('pagesAdd')->withErrors($validator)->withInput();

        }
        if($request->hasFile('images')) {
            $file = $request->file('images');
            $input['images'] = $file->getClientOriginalName();
            $file->move(public_path().'/assets/img', $input['images']);
        }
        $page = new Page();
        $page->fill($input);
        if ($page->save()) {
            return redirect('admin')->with('status','Страница добавлена');
        }
    }
    public function destroy(Page $page) {
        
        $page->delete();
        return redirect('admin')->with('status','Страница уделана');
    }
    
    public function edit(Page $page) {
        $old = $page->toArray();
        if (view()->exists('admin.pages_edit')) {
            $data = [
                'title' => 'Редактирование страницы - '.$old['name'],
                'data' => $old
            ];
            //echo 11; dd();
            return view('admin.pages_edit',$data);
        }
    }

    public function update(Page $page, Request $request) {
        
        $input = $request->except('_token');
        $validator = Validator::make($input, [
            'name'=>'required|max:255',
            'alias'=>'required|max:255|unique:pages,alias,' . $input['id'],
            'text'=>'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('pagesEdit',['page' => $input['id']])->withErrors($validator);
        }

        if($request->hasFile('images')) {
            $file = $request->file('images');
            $file->move(public_path().'/assets/img', $file->getClientOriginalName());
            $input['images'] = $file->getClientOriginalName();

        }
        else {
            $input['images'] = $input['old_images'];
        }

        unset($input['old_images']);
        $page->fill($input);
        if($page->update()) {
            return redirect('admin')->with('status', 'Страница обновлена');
        }
    }

}
