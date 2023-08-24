<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #8E98D7;">
        <a class="navbar-brand mb-0 h1" href="#">Travelucky</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                @if (Route::has('login'))
                @auth
                <a class="btn btn-outline-light my-2 my-sm-0 me-2 " href="{{ url('home') }}" role="button">My
                    Profile</a>
                @else
                <a class="btn btn-outline-light my-2 my-sm-0 me-2 " href="{{ route('login') }}" role="button">Login</a>

                @endauth
                @endif
            </form>
        </div>
    </nav>
</header>