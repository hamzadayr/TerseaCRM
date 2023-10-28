<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Employee;
use App\Models\Historique;
use App\Models\Entreprise;
use App\Models\Invitation;


class AdminController extends Controller
{
    // Afficher le tableau de bord de l'administrateur
    public function dashboard()
    {
        $totalEmployees = Employee::count();
        $totalCompanies = Entreprise::count();
        $totalInvitations = Invitation::where('status', 'pending')->count();

        $history = Historique::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('history','totalEmployees', 'totalCompanies', 'totalInvitations'));   
    }

    // Afficher la liste des administrateurs
    public function adminList()
    {
        $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté.

        $admins = User::whereHas('role', function ($query) {
                    $query->where('name', 'admin'); // Assurez-vous d'ajuster 'admin' en fonction du nom de votre rôle d'administrateur.
                })
                ->select('name','email')
                ->where('id', '!=', $userId) // Exclut l'utilisateur connecté.
                ->get();
    
       return view('admin.admins.index', ['admins' => $admins]);

    }

    // Traitement du formulaire d'ajout d'un nouvel administrateur
    public function createAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 1; // Remplacez 1 par l'ID du rôle de l'administrateur

        $user->save();

        return response()->json(['message' => 'Administrateur ajouté avec succès'], 200);

    }



}
