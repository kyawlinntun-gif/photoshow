<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('album.index') }}">PhotoShow</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link {{ Request::is('album') ? 'active' : '' }}" href="{{ route('album.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('album/create') ? 'active' : '' }}" href="{{ route('album.create') }}">Create Album</a>
                </li>
            </ul>
        </div>
    </div>
</nav>