<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item ">
            <a href="{{route('instructor.dashboard')}}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-title">Bimbel BUC Teva</li>
        <li class="sidebar-item {{ Route::is('instructor.attending*') ? 'active':'' }}">
            <a href="{{ route('instructor.attending') }}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Attending</span>
            </a>
        </li>
    </ul>
</div>

