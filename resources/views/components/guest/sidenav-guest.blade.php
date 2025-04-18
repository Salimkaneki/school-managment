<nav class="navbar navbar-expand-lg bg-white bg-opacity-75 shadow-lg position-absolute top-0 start-0 end-0 mx-4 my-3 rounded-4 border-0 py-3">
    <div class="container">
        <button class="navbar-toggler border-0 px-0" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navigation" 
                aria-controls="navigation" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ is_current_route('sign-up') ? 'active fw-semibold' : '' }}"
                        href="{{ route('sign-up') }}">
                        <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="me-2 opacity-75">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                clip-rule="evenodd" />
                        </svg>
                        Inscription
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ is_current_route('sign-in') ? 'active fw-semibold' : '' }}"
                        href="{{ route('sign-in') }}">
                        <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="me-2 opacity-75">
                            <path fill-rule="evenodd"
                                d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z"
                                clip-rule="evenodd" />
                        </svg>
                        Connexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Pour le menu mobile -->
<div class="collapse navbar-collapse-mobile position-fixed top-0 start-0 end-0 bg-white p-4 rounded-bottom-4 shadow-lg" id="navigation">
    <ul class="navbar-nav gap-3">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-3 {{ is_current_route('sign-up') ? 'active fw-semibold' : '' }}"
                href="{{ route('sign-up') }}">
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="me-3 opacity-75">
                    <path fill-rule="evenodd"
                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                        clip-rule="evenodd" />
                </svg>
                Inscription
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-3 {{ is_current_route('sign-in') ? 'active fw-semibold' : '' }}"
                href="{{ route('sign-in') }}">
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="me-3 opacity-75">
                    <path fill-rule="evenodd"
                        d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z"
                        clip-rule="evenodd" />
                </svg>
                Connexion
            </a>
        </li>
    </ul>
</div>