<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\SchoolEvent;

class SchoolNotificationBell extends Component
{
    public $recentEvents;
    public $unreadCount;

    public function __construct()
    {
        $this->recentEvents = SchoolEvent::latest()
            ->take(5)
            ->get();
            
        $this->unreadCount = $this->recentEvents->count();
    }

    public function render()
    {
        return view('components.school-notification-bell');
    }
}