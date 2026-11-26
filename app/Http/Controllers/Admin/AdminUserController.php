<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Recherche par nom, email ou téléphone.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filtrage par rôle.
        if ($request->filled('role') && in_array($request->role, ['client', 'admin'])) {
            $query->where('role', $request->role);
        }

        // Liste paginée.
        $users = $query
            ->withCount('reservations')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Statistiques générales.
        $totalUsers = User::count();

        $totalClients = User::where('role', 'client')->count();

        $totalAdmins = User::where('role', 'admin')->count();

        $recentUsers = User::where('created_at', '>=', now()->subDays(7))
            ->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalClients',
            'totalAdmins',
            'recentUsers'
        ));
    }

    /**
 * Afficher le formulaire de création d'un client.
 */
public function create()
{
    return view('admin.users.create');
}

/**
 * Enregistrer un nouveau client.
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'phone' => ['nullable', 'string', 'max:30'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = new User();

    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? null;
    $user->password = $validated['password'];

    // Un compte créé depuis cette page est toujours un client.
    $user->role = 'client';

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Le compte client a été créé avec succès.');
}
}