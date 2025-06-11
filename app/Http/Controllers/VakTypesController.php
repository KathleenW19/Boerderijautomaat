<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VakType;

class VakTypesController extends Controller
{
    public function index()
    {
        $vakTypes = VakType::all();
        return view('vaktypes.index', compact('vakTypes'));
    }

    public function create()
    {
        return view('vakTypes.create');
    }

    public function edit($id){

        $vakType = VakType::findOrFail($id);
        return view('vaktypes.edit', compact('vakType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        // VakType daadwerkelijk opslaan
        VakType::create([
            'naam' => $request->input('naam'),
        ]);

        return redirect()->route('vakTypes.index')->with('success', 'Vaktype succesvol aangemaakt.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        $vakType = VakType::findOrFail($id);
        $vakType->naam = $request->input('naam');
        $vakType->save();

        return redirect()->route('vakTypes.index')->with('success', 'Vaktype succesvol bijgewerkt.');
    }

    public function delete($id){
        $VakType = VakType::findOrFail($id);
        $VakType->delete();

        return redirect()->route('vakTypes.index')->with('success', 'Vaktype succesvol verwijderd.');
    }
}
