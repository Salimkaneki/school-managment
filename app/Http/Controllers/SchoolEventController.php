<?php
namespace App\Http\Controllers;

use App\Models\SchoolEvent;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolEventController extends Controller
{
    public function index()
    {
        $events = SchoolEvent::where('school_id', Auth::id())
            ->orderBy('event_date', 'desc')
            ->paginate(10);
        return view('events.index', ['events' => $events]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
        ]);

        $validatedData['school_id'] = Auth::id();

        SchoolEvent::create($validatedData);

        return redirect()->route('event-list')
            ->with('success', 'Événement créé avec succès.');
    }

    public function getNotifications()
    {
        $school = School::find(Auth::id());
        
        // Récupérer uniquement les événements de l'école connectée
        $recentEvents = SchoolEvent::where('school_id', $school->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $unreadCount = SchoolEvent::where('school_id', $school->id)
            ->where('created_at', '>', $school->last_notification_read ?? now()->subYears(10))
            ->count();

        return [
            'recentEvents' => $recentEvents,
            'unreadCount' => $unreadCount
        ];
    }

    public function show(SchoolEvent $event)
    {
        if ($event->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = SchoolEvent::findOrFail($id);
        
        if ($event->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
        
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = SchoolEvent::findOrFail($id);
        
        if ($event->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
        ]);

        $validatedData['school_id'] = Auth::id();

        $event->update($validatedData);

        return redirect()->route('event-list')
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(SchoolEvent $event)
    {
        if ($event->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        $event->delete();
        
        return redirect()->route('event-list')
            ->with('success', 'Événement supprimé avec succès.');
    }
}