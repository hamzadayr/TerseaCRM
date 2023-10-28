<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    // Méthode d'affichage du formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Méthode de traitement du formulaire de connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role->name === 'admin') {
                // Redirection pour les administrateurs
                return redirect()->route('admin.dashboard');
            } elseif ($user->role->name === 'employe') {
                // Redirection pour les employés
                return redirect()->route('employee.profile');
            }
        }

    
        return redirect()->route('login')->with('error', 'Adresse e-mail ou mot de passe incorrect.');
    }

    // Méthode pour afficher le formulaire d'ajout d'un nouvel administrateur
    public function showAdminRegistrationForm()
    {
        return view('auth.register');
    }

    // Méthode pour enregistrer un nouvel administrateur
    public function registerAdmin(Request $request)
    {
        // Valider les données du formulaire d'inscription
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Créer un nouvel utilisateur avec le rôle d'administrateur
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Attribuer le rôle d'administrateur à l'utilisateur
        $adminRole = Role::where('name', 'admin')->first(); // Assurez-vous que 'admin' est le nom du rôle d'administrateur
        $user->assignRole($adminRole);

        // Connectez automatiquement l'administrateur après l'inscription
        Auth::login($user);

        // Rediriger l'administrateur vers le tableau de bord
        return redirect()->route('admin.dashboard');
    }

    // Méthode de déconnexion
    public function logout()
    {
        Auth::logout(); // Déconnecte l'utilisateur

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
