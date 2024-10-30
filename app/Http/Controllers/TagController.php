<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Exception;
use Illuminate\Cache\TagSet;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(15);
        return view('tags.index')->with('tags',$tags);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function create_post(Request $request)
    {
        $tag = new Tag();
        $tag->color = $request->input('color');
        $tag->name = $request->tagname;

        try {
            if($tag->save())
            {
                return redirect()->route('admin.tags.list')->with('success','A címke létrehozása sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.tags.list')->with('failed','A címke létrehozása sikertelen!');

        }
    }

    public function Edit($id)
    {
        $tag = Tag::find($id);

        return view('tags.edit')->with('tag',$tag);
    }
    public function Edit_Post(Request $request)
    {
        $tag = Tag::findOrFail($request->input('id'));
    
        $tag->name = $request->input('tagname');
        $tag->color = $request->input('color');
    
        try {
            if($tag->save())
            {
                return redirect()->route('admin.tags.list')->with('success', 'A címke frissítése sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.tags.list')->with('failed', 'A címke frissítése sikertelen!');
        }
    }
    
}
