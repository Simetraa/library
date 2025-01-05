<div class="page-header">
    <div class="flex-horizontal gap-16">
        <h1><a href="/">Atlas Books</a></h1>
        <nav class="gap-32">
            @can('access-staff-and-admin-pages')
                <a href="/books">Books</a>
                <a href="/branches">Branches</a>
                <a href="/branches/{{Auth::user()->branch->id}}">Dashboard</a>
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
            @can('access-staff-and-admin-pages')
                    <a href="/branches/{{Auth::user()->branch->id}}/staff/{{Auth::user()->id}}/edit">{{ Auth()->user()->email }}</a>
            @endcan
            @can('access-user-pages')
                    <a href="/account">{{ Auth::user()->email }}</a>
            @endcan

                    <form method="POST" action="/logout">
                @csrf
                <button class="button-p">Log out</button>
            </form>
        @endauth
    </div>
</div>
