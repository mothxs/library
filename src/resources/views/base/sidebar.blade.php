<div class="library-sidebar">
    {{-- <div class="library-app-title">BIBLIOTECA</div> --}}
    <div class="library-menu-list">
        <ul>
            <li class="library-menu-item">
                <span class="library-icon material-icons">
                    menu_book
                </span>
                <a href="/library/books" class="library-menu-link {{ $view == 'books'? 'library-is-active' : ''}}">Libros</a>
            </li>
            <li class="library-menu-item">
                <span class="library-icon material-icons">
                    person
                </span>
                <a href="/library/authors" class="library-menu-link {{ $view == 'authors'? 'library-is-active' : ''}}">Autores</a>
            </li>
            <li class="library-menu-item">
                <span class="library-icon material-icons">
                    store_mall_directory
                </span>
                <a href="/library/editorials" class="library-menu-link {{ $view == 'editorials'? 'library-is-active' : ''}}">Editoriales</a>
            </li>
            <li class="library-menu-item">
                <span class="library-icon material-icons">
                    groups
                </span>
                <a href="/library/partners" class="library-menu-link {{ $view == 'partners'? 'library-is-active' : ''}}">Socios</a>
            </li>
            <li class="library-menu-item">
                <span class="library-icon material-icons">
                    list_alt
                </span>
                <a href="/library/rents" class="library-menu-link {{ $view == 'rents'? 'library-is-active' : ''}}">Alquileres</a>
            </li>
        </ul>
    </div>
    <div class="library-profile">
        <div class="library-user-info">
            <span class="library-icon material-icons">
                account_circle
            </span>
            <span class="library-user-name">{{ucfirst(Auth::user()->name)}}</span>
            <a class="library-logout" href="/logout">
                <span class="library-icon material-icons">
                    logout
                </span>
            </a>
        </div>
    </div>
</div>
