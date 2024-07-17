<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    //
    public function visi(){
        return view('admin.visi.index',[
            'title' => 'Vision',
            'visions' => VisiMisi::where('type','visi')->get(),
        ]);
    }

    public function visi_create(){
        return view('admin.visi.create',[
            'title' => 'Create Vision',
        ]);
    }

    public function visi_store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'type' => 'visi',
        ];
        VisiMisi::create($data);
        return redirect()->route('admin.visi')->with('success','Vission successfully created');
    }

    public function misi(){
        return view('admin.misi.index',[
            'title' => 'Misi',
            'missions' => VisiMisi::where('type','misi')->get(),
        ]);
    }

    public function misi_create(){
        return view('admin.misi.create',[
            'title' => 'Create Misi',
        ]);
    }

    public function misi_store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'type' => 'misi',
        ];
        VisiMisi::create($data);
        return redirect()->route('admin.misi')->with('success','Vission successfully created');
    }

    
}
