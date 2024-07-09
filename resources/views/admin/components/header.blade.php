<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-start">
                    <li class="breadcrumb-item active" aria-current="page">
                        {{-- @yield('title') --}}
                    </li>
                </ol>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item active" aria-current="page">
                        @yield('title')
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div>
