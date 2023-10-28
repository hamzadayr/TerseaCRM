<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Invitation;
use App\Models\Employee;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Historique;
use App\Mail\InvitationEmail;

class InvitationController extends Controller
{
    // Affichage de la liste des invitations envoyées et annulés
    public function index(){
        $invitations = Invitation::with(['entreprise', 'user'])
            ->orderBy('created_at', 'desc')->get();
        $entreprises = Entreprise::all();
        return view('admin.employees.invitation', compact('invitations','entreprises'));
    }
    
    // Envoie une invitation à un employé
    public function inviteEmployee(Request $request)
    {
        // Générer un jeton d'invitation unique
        $token = Str::random(30);

        $user = Auth::user();
        try{
            // Créez une nouvelle invitation dans la base de données
            $invitation = new Invitation();
            $invitation->token = $token;
            $invitation->email = $request->input('email');
            $invitation->user_id = $user->id;
            $invitation->entreprise_id = $request->input('entreprise_id');
            $invitation->save();

            // Envoyer un e-mail à l'employé avec le lien d'invitation
            Mail::to($invitation->email)->send(new InvitationEmail($invitation));
            
            // Tracer dans la l'historique
            Historique::addToHistory( "/ Admin {$user->name} à envoyé une invitation à {$invitation->email}");
            return response()->json(['message' => 'Invitation envoyée avec succès, et tracé dans l historique'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors d\'envoi d\'invitation'], 500);
        }

    }

    // Annule une invitation
    public function cancelInvitation($invitationId)
    {
        try{
            // Annuler l'invitation
            $invitation = Invitation::find($invitationId);
            $invitation->update(['status' => 'canceled']);

            // Tracer dans la l'historique
            $user = Auth::user();
            Historique::addToHistory( "/ Admin {$user->name} à annulé l'invitation envoyé à {$invitation->email}");

            return response()->json(['message' => 'Invitation annulée avec succès, et tracé dans l historique'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de l annulation de l invitation'], 500);
        }
    }

    // Accepte une invitation
    public function acceptInvitation($token)
    {
        // Recherchez l'invitation correspondant au jeton dans la base de données
        $invitation = Invitation::with('entreprise')
                    ->where('token', $token)
                    ->where('status', 'pending')
                    ->first();
 
        if (!$invitation || $invitation->status != 'pending') {
            return redirect()->route('login')->with('error', 'L\'invitation est invalide ou a déjà été acceptée.');
        }

        return view('employe.create-password', compact('invitation'));
    }

    // Méthode pour valider le mot de passe après la soumission du formulaire
    public function completeInvitation(Request $request)
    {
        // Validez le formulaire ici et assurez-vous que le mot de passe est conforme aux règles

        $invitation = Invitation::where('token', $request->input('token'))->first();

        if (!$invitation || $invitation->status != 'pending') {
            return redirect()->route('login')->with('error', 'L\'invitation est invalide ou a déjà été acceptée.');
        }
        if ($request->password != $request->password_confirmation) {
             return response()->json(['message' => 'Le mot de passe et la confirmation ne correspondent pas.'], 500);
        }
        // Créez l'employé avec le nouveau mot de passe
        $user = new User();
        $user->email = $invitation->email;
        $user->name = $request->input('name');
        $user->role_id = 2;
        $user->password = bcrypt($request->input('password'));
        

        if($user->save()){
            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->entreprise_id =$invitation->entreprise_id;
            $employee->save();

            // Marquez l'invitation comme validée
            $invitation->status = 'confirmed';
            $invitation->save();

            Historique::addToHistory( "/ L\'employé {$user->name} à confirmer son invitation.");


            return response()->json(['message' => 'Votre compté à été bien créé, Merci!'], 200);
        }else{
            return response()->json(['message' => 'Une erreur s\'est produite, merci de réessayer ultérieurement'], 500);
        }

    }
}
