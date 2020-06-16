<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disneyplus;
use PDF;

class DisneyplusController extends Controller
{
    //

    public function index()
{
        $shows = Disneyplus::all();

        return view('list', compact('shows'));
}

public function downloadPDF($id) {
    $show = Disneyplus::find($id);
    $pdf = PDF::loadView('pdf', compact('show'));
    
    return $pdf->download('disney.pdf');
}
    public function create()
    {
        return view('form');
    }

    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'show_name' => 'required|max:255',
            'series' => 'required|max:255',
            'lead_actor' => 'required|max:255',
        ]);
        Disneyplus::create($validatedData);
   
        return redirect('/disneyplus')->with('success', 'Disney Plus Show is successfully saved');
    }

    public function store(Request $request)
    {
        $shows = Disneyplus::all();
        $validatedData = $request->validate([
            'show_name' => 'required|max:255',
            'series' => 'required|max:255',
            'lead_actor' => 'required|max:255',
           
        ]);

        $user = Disneyplus::create($validatedData);
        $lastId =$user->id;
        echo $lastId;

        $show = Disneyplus::find($lastId);
        $pdf = PDF::loadView('pdf', compact('show'));
        
        return $pdf->download('disney.pdf');
      }

}
