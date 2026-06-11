<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
    public function index()
    {
        $users = User::with('roles')->paginate(15);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Assigner un rôle à un utilisateur
     */
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', "Rôle '{$request->role}' assigné à l'utilisateur.");
    }

    /**
     * Retirer un rôle d'un utilisateur
     */
    public function removeRole(User $user, $role)
    {
        $user->removeRole($role);

        return redirect()->back()->with('success', "Rôle '{$role}' retiré de l'utilisateur.");
    }

    /**
     * Afficher le formulaire de création d'utilisateur
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name'
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(), // Auto-verify pour les comptes créés par admin
        ]);

        // Assigner le rôle
        $user->assignRole($validated['role']);

        // Envoyer email de bienvenue avec mot de passe temporaire
        Mail::queue(new AccountCreated($user, $validated['password']));

        return redirect()->route('admin.users.index')->with('success', "Utilisateur '{$user->name}' créé avec succès. Un email de bienvenue a été envoyé.");
    }
}
