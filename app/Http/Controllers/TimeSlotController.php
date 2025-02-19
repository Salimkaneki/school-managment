<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\Auth;

class TimeSlotController extends Controller
{
    public function create()
    {
        return view('time-slots.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        TimeSlot::create([
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_active' => true,
            'school_id' => Auth::id() // Ajout de l'ID de l'école connectée
        ]);

        return redirect()->route('time-slots.index')
            ->with('success', 'Créneau horaire ajouté');
    }

    public function index()
    {
        // Récupérer uniquement les créneaux horaires de l'école connectée
        $timeSlots = TimeSlot::where('school_id', Auth::id())
                           ->orderBy('start_time')
                           ->paginate(10);

        return view('time-slots.index', compact('timeSlots'));
    }

    public function edit(TimeSlot $timeSlot)
    {
        // Vérifier que ce créneau horaire appartient à l'école connectée
        if ($timeSlot->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        return view('time-slots.edit', compact('timeSlot'));
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        // Vérifier que ce créneau horaire appartient à l'école connectée
        if ($timeSlot->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'boolean'
        ]);

        $timeSlot->update($validated);

        return redirect()->route('time-slots.index')
            ->with('success', 'Créneau horaire mis à jour');
    }

    public function destroy(TimeSlot $timeSlot)
    {
        // Vérifier que ce créneau horaire appartient à l'école connectée
        if ($timeSlot->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        $timeSlot->delete();

        return redirect()->route('time-slots.index')
            ->with('success', 'Créneau horaire supprimé');
    }
}