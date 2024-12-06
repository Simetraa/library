<div class="page-header">
    <div class="flex-horizontal gap-16">
        <h1><a href="/">Atlas Books</a></h1>
        <nav class="gap-32">
            <a href="/account">Account</a>
            <a href="/inventory">Inventory</a>
        </nav>
    </div>

    <div class="header-buttons">
        @guest
            <a href="/login" id = login-button>Log In</a>
            <a href="/register" id = signup-button>Sign Up</a>
        @endguest

        @auth
            <a href="/account">{{ Auth()->user()["email"] }}</a>
            <form method="POST" action="/logout">
                @csrf

                <button>Log out</button>
            </form>
        @endauth
    </div>
</div>
