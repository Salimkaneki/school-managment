<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;

class TimeSlotController extends Controller
{
    //

    // Dans TimeSlotController
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
        'is_active' => true
    ]);

    return redirect()->route('time-slots.index')
        ->with('success', 'Créneau horaire ajouté');
}

public function index()
{
    $timeSlots = TimeSlot::paginate(10); 
    return view('time-slots.index', compact('timeSlots'));
}

public function edit(TimeSlot $timeSlot)
{
    return view('time-slots.edit', compact('timeSlot'));
}

public function update(Request $request, TimeSlot $timeSlot)
{
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
    $timeSlot->delete();

    return redirect()->route('time-slots.index')
        ->with('success', 'Créneau horaire supprimé');
}
}
