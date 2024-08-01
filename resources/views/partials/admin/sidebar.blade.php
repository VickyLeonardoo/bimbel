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
        <li class="sidebar-item {{Route::is('admin.instructor*') ? 'active':''}}">
            <a href="{{route('admin.instructor')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Instructor</span>
            </a>
        </li>
        <li class="sidebar-item {{Route::is('admin.visi*') ? 'active':''}}">
            <a href="{{route('admin.visi')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Visi</span>
            </a>
        </li>
        <li class="sidebar-item {{Route::is('admin.misi*') ? 'active':''}}">
            <a href="{{route('admin.misi')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Misi</span>
            </a>
        </li>
        <li class="sidebar-item {{Route::is('admin.year*') ? 'active':''}}">
            <a href="{{route('admin.year')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Year</span>
            </a>
        </li>
        <li class="sidebar-title">Application</li>
        <li class="sidebar-item {{ Route::is('admin.transaction*') ? 'active':'' }}">
            <a href="{{ route('admin.transaction') }}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Application</span>
            </a>
        </li>
        <li class="sidebar-item {{ Route::is('admin.enrollment*') ? 'active':'' }}">
            <a href="{{ route('admin.enrollment') }}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Enrollment</span>
            </a>
        </li>
        <li class="sidebar-title">Bimbel BUC Teva</li>
        <li class="sidebar-item {{ Route::is('admin.attending*') ? 'active':'' }}">
            <a href="{{ route('admin.attending') }}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Attending</span>
            </a>
        </li>
        {{-- <li class="sidebar-item">
            <a href="" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Enrollment</span>
            </a>
        </li> --}}
    </ul>
</div>

