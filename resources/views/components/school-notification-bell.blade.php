<div>
    {{-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="notificationDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <div class="position-relative">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="cursor-pointers">
                    <path fill-rule="evenodd"
                        d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                        clip-rule="evenodd" />
                </svg>
                @if($unreadCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadCount }}
                    </span>
                @endif
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="notificationDropdown">
            @forelse($recentEvents as $event)
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('events.show', $event->id) }}">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                                <div class="avatar avatar-sm border-radius-sm bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Nouvel événement scolaire</span>
                                </h6>
                                <p class="text-xs mb-0">
                                    {{ Str::limit($event->title, 40) }}
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Date : {{ $event->formattedEventDate() }}
                                </p>
                                <p class="text-xs text-secondary mb-0 d-flex align-items-center">
                                    <i class="fa fa-clock opacity-6 me-1"></i>
                                    {{ $event->timeAgo() }}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="text-center py-2">
                    <p class="text-xs text-secondary mb-0">Aucun événement récent</p>
                </li>
            @endforelse
        </ul>
    </li> --}}

    @php
        $school = Auth::check() ? \App\Models\School::find(Auth::id()) : null;

        if ($school) {
            $recentEvents = \App\Models\SchoolEvent::where('school_id', $school->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            $unreadCount = \App\Models\SchoolEvent::where('school_id', $school->id)
                ->where('created_at', '>', $school->last_notification_read ?? now()->subYears(10))
                ->count();
        }
    @endphp


<li class="nav-item dropdown pe-2 d-flex align-items-center">
    <a href="javascript:;" class="nav-link text-body p-0" id="notificationDropdown"
        data-bs-toggle="dropdown" aria-expanded="false">
        <div class="position-relative">
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor" class="cursor-pointers">
                <path fill-rule="evenodd"
                    d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                    clip-rule="evenodd" />
            </svg>
            @if($unreadCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $unreadCount }}
                </span>
            @endif
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="notificationDropdown">
        @forelse($recentEvents as $event)
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="{{ route('events.show', $event->id) }}">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <div class="avatar avatar-sm border-radius-sm bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Nouvel événement scolaire</span>
                            </h6>
                            <p class="text-xs mb-0">
                                {{ Str::limit($event->title, 40) }}
                            </p>
                            <p class="text-xs text-secondary mb-0">
                                Date : {{ $event->formattedEventDate() }}
                            </p>
                            <p class="text-xs text-secondary mb-0 d-flex align-items-center">
                                <i class="fa fa-clock opacity-6 me-1"></i>
                                {{ $event->timeAgo() }}
                            </p>
                        </div>
                    </div>
                </a>
            </li>
        @empty
            <li class="text-center py-2">
                <p class="text-xs text-secondary mb-0">Aucun événement récent</p>
            </li>
        @endforelse
    </ul>
</li>

{{-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
    @if($school)
        <a href="javascript:;" class="nav-link text-body p-0" id="notificationDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <div class="position-relative">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="cursor-pointers">
                    <path fill-rule="evenodd"
                        d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                        clip-rule="evenodd" />
                </svg>
                @if($unreadCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadCount }}
                    </span>
                @endif
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="notificationDropdown">
            @forelse($recentEvents as $event)
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('events.show', $event->id) }}">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                                <div class="avatar avatar-sm border-radius-sm bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Nouvel événement scolaire</span>
                                </h6>
                                <p class="text-xs mb-0">
                                    {{ Str::limit($event->title, 40) }}
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Date : {{ $event->formattedEventDate() }}
                                </p>
                                <p class="text-xs text-secondary mb-0 d-flex align-items-center">
                                    <i class="fa fa-clock opacity-6 me-1"></i>
                                    {{ $event->timeAgo() }}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="text-center py-2">
                    <p class="text-xs text-secondary mb-0">Aucun événement récent</p>
                </li>
            @endforelse
        </ul>
    @else
        <p class="text-xs text-secondary mb-0">Aucune école associée à votre compte</p>
    @endif
</li> --}}

</div>