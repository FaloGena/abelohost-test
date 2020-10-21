<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">TaskWatch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <span class="navbar-text"></span>
        @guest
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a type="button" class="nav-link text-white font-weight-bold" data-toggle="modal" data-target="#loginModal">Sign
                        In</a>
                </li>
            </ul>
            <span class="navbar-text">or</span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="/register">Sign Up</a>
                </li>
            </ul>
        @endguest
        @auth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold" href="/">{{Auth::user()->name}}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log out
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endauth
    </div>
</nav>
