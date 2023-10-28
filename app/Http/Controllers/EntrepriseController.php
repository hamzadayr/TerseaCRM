<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    // Affiche la liste des entreprises
    public function index()
    {
        return view('admin.entreprises.index');
    }

     // Affiche la liste des entreprises
     public function show()
     {
        $entreprises = Entreprise::all();
        return response()->json(['data' => $entreprises]);
    }

    // Affiche le formulaire de création d'une entreprise
    public function create()
    {
        return view('admin.entreprises.create');
    }

    // Enregistre une nouvelle entreprise dans la base de données
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = time() . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('',$logoName, 'public');
        }
    
        $entreprise = new Entreprise;
        $entreprise->name = $request->input('name');
        $entreprise->description = $request->input('description');
        $entreprise->logo = $logoPath;
        $entreprise->save();
    
        return response()->json(['success' => 'Entreprise créée avec succès']);
    
    }


    // Affiche le formulaire de modification d'une entreprise
    public function edit(Entreprise $entreprise)
    {
        return view('entreprises.edit', compact('entreprise'));
    }

    // Met à jour une entreprise dans la base de données
    public function update(Request $request, Entreprise $entreprise)
    {
        // Valider les données du formulaire ici

        $entreprise->update($request->all());
        return redirect()->route('entreprises.index');
    }

    // Supprime une entreprise
    public function destroy($id)
    {
        try {
            $entreprise = Entreprise::find($id);
            
            // Vérifier si l'entreprise a des employés
            if ($entreprise->employees->isNotEmpty()) {
                return response()->json(['message' => 'Impossible de supprimer l\'entreprise car elle a des employés.'], 400);
            }
            // Supprimer le fichier image du logo s'il existe
            if ($entreprise->logo) {
                Storage::delete('public/' . $entreprise->logo);
            }
            $entreprise->delete();
            return response()->json(['message' => 'Entreprise supprimée avec succès'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression de l\'entreprise'], 500);
        }
    }


  
}
