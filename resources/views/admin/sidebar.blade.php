<!-- Sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
              Gérer les admins
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('entreprises.index') }}">
                Gérer les entreprises
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.employees') }}">
                Gérer les employés
            </a>
        </li>
        <li class="nav-item logout-section">
            <a class="nav-link" href="{{ route('logout') }}">
                Déconnexion
            </a>
        </li>
    </ul>
</div>
