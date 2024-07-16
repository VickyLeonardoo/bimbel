<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item ">
            <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item {{Route::is('admin.course*') ? 'active':''}}">
            <a href="{{route('admin.course')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Course</span>
            </a>
        </li>
    </ul>
</div>