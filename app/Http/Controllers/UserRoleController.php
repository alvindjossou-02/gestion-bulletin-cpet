<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
