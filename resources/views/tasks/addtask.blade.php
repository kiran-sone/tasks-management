<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Task | Kiran</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Widgets - Small Box" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('assets/css/adminlte.css') }}" as="style" />
    <link rel="preload" href="{{ asset('assets/css/font-awesome.min.css') }}" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('tasks.layout.header')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('tasks.layout.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Add Task</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item active" aria-current="page">Tasks Management</li>
                                <li class="breadcrumb-item active" aria-current="page">Add Task</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <form class="needs-validation" action="{{ url('addtask') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row g-3">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="task_name" class="form-label">Task Name</label>
                                    <input type="text" class="form-control" id="task_name" name="task_name" value="" required>
                                    @error('task_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="project" class="form-label">Project</label>
                                    <select class="form-select" id="project" name="project" required>
                                        <option value="">-- SELECT --</option>
                                        @foreach ($projects as $pkey => $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="task_status" class="form-label">Task Status</label>
                                    <select class="form-select" id="task_status" name="task_status" >
                                        <option value="">-- SELECT --</option>
                                        <option value="ToDo">ToDo</option>
                                        <option value="In-Progress">In-Progress</option>
                                        <option value="Done">Done</option>
                                    </select>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="task_duedate" class="form-label">Due Date</label>
                                    <input type="date" class="form-control" id="task_duedate" name="task_duedate" value="">
                                    @error('task_duedate')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                                
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->

                        <!--begin::Footer-->
                        <div class="card-footer mt-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ url('/tasks') }}" class="btn btn-secondary">Go to Tasks</a>
                        </div>
                        <!--end::Footer-->
                    </form>
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        @include('tasks.layout.footer')
        <!--end::Footer-->

    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    let url = "{{ url('cms/addfruittype') }}";
    let curUrl = "{{ url('cms/fruit-types') }}";
    $(document).ready(function() {
        // Add Task type
        $('#btnAddFruitType').on('click', function(e) {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'fruitType': $("#fruitType").val().trim(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // You can return JSON from controller
                    if (response.status) {
                        alert(response.message);
                        window.location.href = curUrl;
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                    console.log(xhr.responseText);
                }
            });
        });

        // edit fruit type
        $(document).on("click", ".btnEditFruitType", function() {
            let url = "{{ url('cms/updatefruittype') }}";
            let typeId = $(this).data('tid');
            let fruitType = $(".editFruitType" + typeId).val().trim();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'fruitType': fruitType,
                    'typeId': typeId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // You can return JSON from controller
                    if (response.status) {
                        alert(response.message);
                        window.location.href = curUrl;
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                    console.log(xhr.responseText);
                }
            });
        });

        // delete fruit type
        $(document).on("click", ".btnDeleteFruitType", function() {
            let url = "{{ url('cms/deletefruittype') }}";
            let typeId = $(this).data('tid');
            Swal.fire({
                title: "Are you sure to delete?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            'typeId': typeId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // You can return JSON from controller
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                }).then((result) => {
                                    window.location.href = curUrl;
                                });
                            } else {
                                Swal.fire({
                                    title: "An error occured!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Something went wrong!",
                                text: xhr.responseText,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
    </script>

</body>
<!--end::Body-->

</html>