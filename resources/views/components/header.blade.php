<div class="page-header">
    <div class="flex-horizontal gap-16">
        <h1><a href="/">Atlas Books</a></h1>
        <nav class="gap-32">
            @can('access-staff-pages')
                <a href="/books">Books</a>
                <a href="/branches">Branches</a>
            @endcan
            @can('access-user-pages')
                <a href="/account/reservations">Reservations</a>
                <a href="/account/purchases">Purchase History</a>
            @endcan
        </nav>
    </div>

    <div class="header-buttons">
        @guest
            <a href="/login" id = login-button>Log In</a>
            <a href="/register" id = signup-button>Sign Up</a>
        @endguest
        @auth
            <a href="/account">{{ Auth()->user()->email }}</a>
            <form method="POST" action="/logout">
                @csrf
                <button>Log out</button>
            </form>
        @endauth
    </div>
</div>
