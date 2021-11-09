<div class="sidebar">
    <div class="app-title">BIBLIOTECA</div>
    <ul class="menu-list">
        <li class="menu-item">
            <span class="icon material-icons">
                menu_book
            </span>
            <a href="/library/books" class="{{ $view == 'books'? 'is-active' : ''}}">Libros</a>
        </li>
        <li class="menu-item">
            <span class="icon material-icons">
                person
            </span>
            <a href="/library/authors" class="{{ $view == 'authors'? 'is-active' : ''}}">Autores</a>
        </li>
        <li class="menu-item">
            <span class="icon material-icons">
                category
            </span>
            <a href="/library/categories" class="{{ $view == 'categories'? 'is-active' : ''}}">Categorías</a>
        </li>
        <li class="menu-item">
            <span class="icon material-icons">
                store_mall_directory
            </span>
            <a href="/library/editorials" class="{{ $view == 'editorials'? 'is-active' : ''}}">Editoriales</a>
        </li>
    </ul>
    <div class="profile">
        <div class="icon-text">
            <span class="icon material-icons">
                account_circle
            </span>
            <span>{{ucfirst(Auth::user()->name)}}</span>
            <a href="/logout">
                <span class="icon material-icons logout">
                    logout
                </span>
            </a>
        </div>
    </div>
</div>
