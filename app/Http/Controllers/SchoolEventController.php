<?php
namespace App\Http\Controllers;

use App\Models\SchoolEvent;
use Illuminate\Http\Request;
use App\Models\Notification; // Assurez-vous d'avoir un modèle Notification
use Carbon\Carbon;

class SchoolEventController extends Controller
{
    // Method to show the form for creating a new event
    public function create()
    {
        return view('events.create');
    }

    // Method to store a newly created event
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
        ]);

        $event = SchoolEvent::create($validatedData);

        // Créer une notification-+
        // SchoolEvent::create([
        //     'title' => 'Nouvel Événement',
        //     'description' => 'Un nouvel événement a été créé: ' . $event->title,
        //     'event_date' => Carbon::now(),
        // ]);

        return redirect()->route('event-list')->with('success', 'Événement créé avec succès.');
    }

    // Method to display a list of events
    public function index()
    {
        $events = SchoolEvent::all();
        return view('events.index', compact('events'));
    }

    public function destroy($id)
    {
        $event = SchoolEvent::findOrFail($id);

        $event->delete();

        return redirect()->route('event-list')->with('success', 'Évènement supprimé avec succès.');
    }
}
