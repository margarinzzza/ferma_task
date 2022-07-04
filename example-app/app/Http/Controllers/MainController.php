<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    public function index()
    {
        $objects = \App\Models\objects::paginate(9);
        $categories = \App\Models\categories::All();
        return view('welcome', ['objects' => $objects, 'categories' => $categories]);
    }

    public function admin_panel()
    {
        $objects = \App\Models\objects::All();
        $categories = \App\Models\categories::All();
        return view('admin_panel', ['objects' => $objects, 'categories' => $categories]);
    }

    public function redact_object_page($id)
    {
        $object = \App\Models\objects::find($id);
        $categories = \App\Models\categories::All();
        return view('redact_object_page', ['object' => $object, 'categories' => $categories]);
    }

    public function redact_object($id, Request $req)
    {
        $object = \App\Models\objects::find($id);
        $object->name = $req->input('name');
        $object->category = $req->input('category');
        if ($req->file('image') == NULL) {
        } else {
            $date = date('YmdHis');
            $imgname = $date . '_' . $req->file('image')->getClientOriginalName();
            $object->img = $imgname;
            $file = $req->file('image');
            Storage::putFileAs('/', $file, $imgname);
        }
        $object->save();
        return redirect('../admin_panel');
    }

    public function add_object(Request $req)
    {
        $object = new \App\Models\objects();
        $object->name = $req->input('name');
        $object->category = $req->input('category');
        $date = date('YmdHis');
        $imgname = $date . '_' . $req->file('image')->getClientOriginalName();
        $object->img = $imgname;
        $file = $req->file('image');
        Storage::putFileAs('/', $file, $imgname);
        $object->save();
        return redirect()->back();
    }

    public function add_category(Request $req)
    {
        $category = new \App\Models\categories();
        $category->name = $req->input('name');
        $category->save();
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = \App\Models\categories::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function delete_object($id)
    {
        $object = \App\Models\objects::find($id);
        $object->delete();
        return redirect()->back();
    }

    public function filter_objects($name)
    {
        $categories = \App\Models\categories::All();
        $category = \App\Models\categories::where('name', $name)->value('name');
        $objects = \App\Models\objects::where('category', $category)->paginate(9);
        return view('welcome', ['objects' => $objects, 'categories' => $categories]);
    }

}
