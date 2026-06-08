<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord basé sur le rôle de l'utilisateur
     */
    public function index()
    {
        return view('dashboard');
    }
}
