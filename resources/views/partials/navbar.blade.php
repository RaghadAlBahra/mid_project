<nav class="navbar navbar-dark bg-dark sticky-top shadow px-4">
    <a class="navbar-brand font-monospace fw-bold" href="#">Admin Portal</a>
    <div class="navbar-nav">
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </div>
</nav>
