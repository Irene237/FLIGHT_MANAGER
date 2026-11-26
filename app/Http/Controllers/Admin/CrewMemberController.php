<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use App\Models\CrewAssignment;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CrewMemberController extends Controller
{
    /**
     * Afficher la liste des membres et des affectations.
     */
    public function index(Request $request)
    {
        // Liste des membres d'équipage.
        $query = CrewMember::query()
            ->withCount([
                'assignments',
                'maintenanceInterventions',
            ]);

        // Recherche.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('employee_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filtrer par fonction.
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filtrer par statut.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $crewMembers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistiques générales.
        $totalCrew = CrewMember::count();

        $activeCrew = CrewMember::where('status', 'active')->count();

        $inactiveCrew = CrewMember::where('status', 'inactive')->count();

        $technicians = CrewMember::where('role', 'technician')->count();

        // Vols programmés et dont le départ est futur.
        $availableFlights = Flight::with([
            'departureAirport',
            'arrivalAirport',
        ])
            ->where('status', 'scheduled')
            ->where('departure_at', '>', now())
            ->orderBy('departure_at')
            ->get();

        // Membres actifs pouvant être affectés aux vols.
        $availableCrewMembers = CrewMember::where('status', 'active')
            ->whereIn('role', [
                'captain',
                'first_officer',
                'flight_attendant',
                'chief_flight_attendant',
            ])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        // Liste détaillée des dernières affectations.
        $crewAssignments = CrewAssignment::with([
            'crewMember',
            'flight.departureAirport',
            'flight.arrivalAirport',
        ])
            ->latest('assigned_at')
            ->take(50)
            ->get();

        return view('admin.crew.index', compact(
            'crewMembers',
            'totalCrew',
            'activeCrew',
            'inactiveCrew',
            'technicians',
            'availableFlights',
            'availableCrewMembers',
            'crewAssignments'
        ));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        return view('admin.crew.create');
    }

    /**
     * Enregistrer un nouveau membre.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:50',
                'unique:crew_members,employee_number',
            ],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:crew_members,email',
            ],
            'phone' => ['required', 'string', 'max:30'],
            'role' => [
                'required',
                Rule::in([
                    'captain',
                    'first_officer',
                    'flight_attendant',
                    'chief_flight_attendant',
                    'technician',
                ]),
            ],
            'license_number' => ['nullable', 'string', 'max:100'],
            'hire_date' => ['nullable', 'date', 'before_or_equal:today'],
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                    'on_leave',
                    'suspended',
                ]),
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        CrewMember::create($validated);

        return redirect()
            ->route('admin.crew.index')
            ->with('success', 'Le membre d’équipage a été ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(CrewMember $crewMember)
    {
        return view('admin.crew.edit', compact('crewMember'));
    }

    /**
     * Mettre à jour un membre.
     */
    public function update(Request $request, CrewMember $crewMember)
    {
        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('crew_members', 'employee_number')
                    ->ignore($crewMember->id),
            ],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('crew_members', 'email')
                    ->ignore($crewMember->id),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'role' => [
                'required',
                Rule::in([
                    'captain',
                    'first_officer',
                    'flight_attendant',
                    'chief_flight_attendant',
                    'technician',
                ]),
            ],
            'license_number' => ['nullable', 'string', 'max:100'],
            'hire_date' => ['nullable', 'date', 'before_or_equal:today'],
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                    'on_leave',
                    'suspended',
                ]),
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $crewMember->update($validated);

        return redirect()
            ->route('admin.crew.index')
            ->with('success', 'Les informations du membre ont été mises à jour.');
    }

    /**
     * Supprimer un membre sans historique.
     */
    public function destroy(CrewMember $crewMember)
    {
        if (
            $crewMember->assignments()->exists() ||
            $crewMember->maintenanceInterventions()->exists()
        ) {
            return back()->with(
                'error',
                'Impossible de supprimer ce membre : il possède un historique d’affectations ou d’interventions techniques.'
            );
        }

        $crewMember->delete();

        return redirect()
            ->route('admin.crew.index')
            ->with('success', 'Le membre d’équipage a été supprimé.');
    }

    /**
     * Affecter un membre d'équipage à un vol.
     */
    public function storeAssignment(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => [
                'required',
                'integer',
                'exists:flights,id',
            ],
            'crew_member_id' => [
                'required',
                'integer',
                'exists:crew_members,id',
            ],
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);

        $crewMember = CrewMember::findOrFail(
            $validated['crew_member_id']
        );

        // Vérifier la disponibilité du vol.
        if (
            $flight->status !== 'scheduled' ||
            $flight->departure_at <= now()
        ) {
            return back()->with(
                'error',
                'Ce vol ne peut plus recevoir de nouvelles affectations.'
            );
        }

        // Vérifier que le membre est actif.
        if ($crewMember->status !== 'active') {
            return back()->with(
                'error',
                'Ce membre d’équipage n’est pas actif.'
            );
        }

        // Les techniciens ne sont pas du personnel navigant.
        if ($crewMember->role === 'technician') {
            return back()->with(
                'error',
                'Un technicien ne peut pas être affecté comme membre navigant.'
            );
        }

        // Vérifier une affectation existante sur ce vol.
        $alreadyAssigned = CrewAssignment::where(
            'crew_member_id',
            $crewMember->id
        )
            ->where('flight_id', $flight->id)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($alreadyAssigned) {
            return back()->with(
                'error',
                'Ce membre est déjà affecté à ce vol.'
            );
        }

        // Vérifier les conflits horaires avec les autres vols.
        $hasConflict = CrewAssignment::where(
            'crew_member_id',
            $crewMember->id
        )
            ->whereIn('status', ['assigned', 'confirmed'])
            ->whereHas('flight', function ($query) use ($flight) {
                $query->where('departure_at', '<', $flight->arrival_at)
                    ->where('arrival_at', '>', $flight->departure_at);
            })
            ->exists();

        if ($hasConflict) {
            return back()->with(
                'error',
                'Ce membre est déjà affecté à un autre vol pendant cette période.'
            );
        }

        // Enregistrer l'affectation dans la base de données.
        CrewAssignment::create([
            'crew_member_id' => $crewMember->id,
            'flight_id' => $flight->id,
            'assignment_role' => $crewMember->role,
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        return redirect()
            ->route('admin.crew.index')
            ->with(
                'success',
                'Le membre d’équipage a été affecté au vol avec succès.'
            );
    }

    /**
     * Annuler une affectation sans supprimer son historique.
     */
    public function cancelAssignment(CrewAssignment $assignment)
    {
        if (in_array($assignment->status, ['completed', 'cancelled'])) {
            return back()->with(
                'error',
                'Cette affectation ne peut plus être annulée.'
            );
        }

        $assignment->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('admin.crew.index')
            ->with(
                'success',
                'L’affectation a été annulée avec succès.'
            );
    }
}