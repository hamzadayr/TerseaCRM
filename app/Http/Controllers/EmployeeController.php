<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Employee;
use App\Models\Entreprise;

class EmployeeController extends Controller

{

    // Affiche tous les l'employé
    public function index(){
        
        $employees = Employee::with(['entreprise', 'user'])
        ->orderBy('created_at', 'desc')->get();
    
       return view('admin.employees.index', ['employees' => $employees]);
    }


    // Affiche les détails de l'employé
    public function profile()
    {
        return view('employe.profile');
    }

    // Met à jour les informations personnelles de l'employé
    public function updateProfile(Request $request, Employee $employee)
    {
        // Valider les données du formulaire
        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Confirmed valide que password_confirmation est présent et égal à password
            'address' => 'string|nullable',
            'phone' => 'string|min:10',
        ];

        $messages = [
            'name.required' => 'Le champ nom est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // Mettre à jour les informations du profil
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $user->email;
        if (!empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        $employee = $user->employee;
        if ($employee) {
            $employee->address = $request->input('address');
            $employee->phone = $request->input('phone');
            $employee->birthdate = $request->input('birthdate');
            $employee->save();
        }

        return response()->json(['message' => 'Profil mis à jour avec succès']);
    }

}
