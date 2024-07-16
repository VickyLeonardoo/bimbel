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
        <li class="sidebar-item {{Route::is('admin.instr.course*') ? 'active':''}}">
            <a href="{{route('admin.instructor')}}" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Instructor Course</span>
            </a>
        </li>
        <li class="sidebar-title">Application</li>
        <li class="sidebar-item">
            <a href="" class='sidebar-link '>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Pre Application</span>
            </a>
        </li>
    </ul>
</div>