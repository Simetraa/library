<div class="page-header">
    <div class="flex-horizontal gap-16">
        <h1>Atlas Books</h1>
        <nav class="gap-32">
            <a href="/">Catalogue</a>
            <a href="/account">Account</a>
            <a href="/inventory">Inventory</a>
        </nav>
    </div>
    <div class="header-buttons">
        @guest
            <a href="/login">Log In</a>
            <a href="/register">Sign Up</a>
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
