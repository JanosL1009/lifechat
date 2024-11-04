<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function ASZF()
    {
        $aszfpage = Pages::find(1);
       return view('AszfPrivPolicy.aszf')->with('aszfpage',$aszfpage);
    }

    public function PrivPolicy()
    {
        $privpolicypage = Pages::find(2);
        return view('AszfPrivPolicy.privpolicy')->with('privpolicypage',$privpolicypage);
    }
    //admin

    public function Index()
    {
        $pages = Pages::paginate(10);
        return view('Pages.index')->with('pages',$pages);
    }

    public function Edit_Pages($id)
    {
        $pages = Pages::find($id);
        return view('Pages.edit')->with('pages',$pages);
    }

    public function Edit_Pages_Post($id, Request $request)
    {
        $updatepages = Pages::find($id);

        $updatepages->content = $request->input('content');

        try {
            if ($updatepages->save()) {
                return redirect()->route('admin.pages.index')->with('success','Az oldal módosítása sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.pages.index')->with('failed','Az oldal módosítása sikertelen!');
        }
    }





   
}
