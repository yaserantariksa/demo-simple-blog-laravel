<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> --}}
            <!--end::Brand Image--> <!--begin::Brand Text-->
            <span class="brand-text fw-light">Blog</span> <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">TAGS</li>
                <li class="nav-item">
                    <a href="{{ route('tags.index') }}" class="nav-link">
                        <i class="bi bi-tag"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-header">POSTS</li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        <i class="bi bi-journal"></i>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.create') }}" class="nav-link">
                        <i class="bi bi-journal-plus"></i>
                        <p>Add New Post</p>
                    </a>
                </li>
                <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
