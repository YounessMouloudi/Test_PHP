<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::where("statut","approuvé")->get();
        return view("temoignage",compact("temoignages"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:60',
            'message' => 'required|string|max:300',
            'image' => 'image|mimes:jpeg,jpg,png,doc,docx|max:1024', 
        ]);

        if ($request->file('image') === null) {
            $data["image"] = "profile.jpg";
        } 
        else {
            $image = $request->file('image')->getClientOriginalName();
            $data["image"] = $image;
            $request->image->move(public_path('images'),$image);
        }    

        Temoignage::create($data);

        return redirect()->route("temoignage")->with("success","Témoignage ajouté avec succès");
    }

    public function edit(string $id)
    {
        $temoignage = Temoignage::findOrFail($id);

        return view("edit",compact("temoignage"));
    }

    public function update(Request $request, string $id)
    {
        $temoignage = Temoignage::findOrFail($id);

        $data = $request->validate([
            'titre' => 'required|string|max:60',
            'message' => 'required|string|max:300',
            'image' => 'image|mimes:jpeg,jpg,png,doc,docx|max:1024',
            'statut' => ['required', Rule::in(['en attente', 'approuvé', 'rejeté'])]
        ]);
                
        $temoignage->update($data);

        return redirect()->route("administration")->with("success","Témoignage modifié avec succès");
    }

    public function administration(Request $request)
    {
        $temoignages = Temoignage::orderBy("position")->get();

        return view('gestion',compact("temoignages"));
    }

    public function dragdrop(Request $request)
    {
        $positions = json_decode($request->positions,true);
        foreach ($positions as $position) {
            $temoignage = Temoignage::find($position['id']);
            $temoignage->position = $position['position'];
            $temoignage->save();
        }
    }

}
