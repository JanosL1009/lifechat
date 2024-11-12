<?php

namespace App\Http\Controllers;

use App\Models\Radio;
use Exception;
use Illuminate\Http\Request;

class RadioController extends Controller
{
    public function index()
    {
        $radios = Radio::paginate(20);
        return view('Radio.index')->with('radios',$radios); 
    }

    public function Create()
    {
        return view('Radio.create');
    }
    public function Create_Post(Request $request)
    {
        $request->validate([
            'radioname' => 'required',
            'radiolink' => 'required',
            'status' => 'required', 
        ]);
        $radio = new Radio();
        $radio->radioName = $request->radioname;
        $radio->radioURL = $request->radiolink;
        $radio->radioStatus = $request->input('status');
        try {
            if($radio->save())
            {
                return redirect()->route('admin.radio.index')->with('success','Sikeresen hozzáadtad a rádiót!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.radio.index')->with('failed','Nem sikerült hozzáadni a rádiót!');
        }
    }

    public function Edit(int $id)
    {
        $radio = Radio::find($id);
        
        return view('Radio.edit')->with('radio',$radio);
    }

    public function Edit_Post(Request $request)
    {

        $radio = Radio::findOrFail($request->input('id'));
    
        $radio->radioName = $request->input('radioname');
        $radio->radioURL = $request->input('radiolink');
        $radio->radioStatus = $request->input('status');
    
        try {
            if($radio->save())
            {
                return redirect()->route('admin.radio.index')->with('success', 'A rádió frissítése sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.radio.index')->with('failed', 'A rádió frissítése sikertelen!');
        }
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'radioid' => 'required|integer|exists:radios,id', 
        ]);

        try {
            $radioid = $request->input('radioid');
            $res = Radio::where('id', $radioid)->delete();

            if ($res) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Nem sikerült törölni a rádiót.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hiba lépett fel a kérés közben.'], 500);
        }
    }
}
