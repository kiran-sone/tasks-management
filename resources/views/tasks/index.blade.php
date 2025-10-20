<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tasks | Kiran</title>
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

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!--begin::Datatables-->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" /> -->
    <!--end::Datatables-->

    <style>
        .pagination .page-item .page-link {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>


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
                            <h3 class="mb-0">Tasks</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item active" aria-current="page">Tasks Management</li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Tasks</li>
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
                    <!-- Small Box (Stat card) -->
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12 mb-2">
                            @if (session('success'))
                            <div class="alert alert-success mb-2">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger mb-2">
                                {{ session('error') }}
                            </div>
                            @endif
                            <a href="{{ url('addtask') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Add
                                New</a>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12">
                            @if(!empty($tasks))
                            <!-- align items side by side -->
                            <div class="row mb-3">
                                <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                                    <label for="filterDropdown">Filter by Project</label>
                                    <select class="form-select" id="filterDropdown">
                                        <option value="all">All</option>
                                        @foreach ($projects as $tkey => $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                                    <label for="searchInput">Search Tasks</label>
                                    <input type="text" class="form-control" id="searchInput" placeholder="Enter keywords...">
                                </div>
                            </div>

                            <div id="taskTableContainer">
                                @include('tasks.partials.tasks_table')
                            </div>

                            @else
                            <h4 class="text-danger">No data found!</h4>
                            @endif
                        </div>
                    </div>
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

    <!-- Datatables -->
    <!-- <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script> -->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
        // reusable sortable setup
        function initSortable() {
            $("#sortableTaskBody").sortable({
                handle: ".drag-handle",
                update: function (event, ui) {
                    let order = [];
                    $("#sortableTaskBody tr").each(function () {
                        order.push($(this).data("id"));
                    });

                    $.ajax({
                        url: '{{ route("tasks.reorder") }}',
                        method: 'POST',
                        data: {
                            order: order,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            console.log("Priority updated!");
                            // optionally reload or reorder priorities visually
                        },
                        error: function () {
                            alert('Failed to reorder tasks.');
                        }
                    });
                }
            }).disableSelection();
        }

        // initialize sortable on first page load
        initSortable();
    </script>

    <script>
        let curUrl = "{{ url('/') }}";
        $(document).ready(function() {
            // delete task
            $(document).on("click", ".btnDeleteTask", function() {
                let taskId = $(this).data('id');  // Assuming 'fid' contains the task ID
                let deleteUrl = "{{ url('tasks') }}/" + taskId;  // Assuming the route is '/tasks/{task}'
                
                Swal.fire({
                    title: "Are you sure to delete?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            method: 'DELETE',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        // Reload the page or you can remove the deleted task row
                                        window.location.href = curUrl;  // This reloads the page
                                    });
                                } else {
                                    Swal.fire({
                                        title: "An error occurred!",
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

            // var tasksDataTable = new DataTable('#tasksTable');

            // Dropdown change event to filter data
            // $('#filterDropdown').on('change', function() {
            //     var selectedCategory = $(this).val();

            //     if (selectedCategory) {
            //         // If a category is selected, filter based on the second column (Category)
            //         tasksDataTable.column(2).search('^' + selectedCategory + '$', true, false).draw();
            //     } else {
            //         // If no category is selected, reset the filter
            //         tasksDataTable.column(2).search('').draw();
            //     }
            // });

            // ajax based pagination
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if(!url) return;
                let page = url.split('page=')[1];
                let project_id = $('#filterDropdown').val();
                $.ajax({
                    url: "{{ route('tasks.pagination') }}",
                    type: 'GET',
                    data: {
                        page: page,
                        project_id: project_id
                    },
                    success: function(data) {
                        $("#taskTableContainer").html(data);
                        initSortable(); // re-bind sortable on new elements
                    },
                    error: function() {
                        alert('Error loading data.');
                    }
                });
            });

            // filter tasks by project
            $(document).on('change', '#filterDropdown', function(e) {
                let project_id = $(this).val();
                $.ajax({
                    url: "{{ route('tasks.pagination') }}",
                    type: 'GET',
                    data: { project_id: project_id },
                    success: function(data) {
                        $("#taskTableContainer").html(data);
                        initSortable();
                    },
                    error: function() {
                        alert('Error loading data.');
                    }
                });
            });

            // search tasks by name
            let typingTimer;
            let doneTypingInterval = 1000; // 1 second
            $(document).on('input', '#searchInput', function(e) {
                clearTimeout(typingTimer);
                let searchTerm = $(this).val();
                typingTimer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('tasks.pagination') }}",
                        type: 'GET',
                        data: { search_key: searchTerm },
                        success: function(data) {
                            $("#taskTableContainer").html(data);
                            initSortable();
                        },
                        error: function() {
                            alert('Error loading data.');
                        }
                    });
                }, doneTypingInterval);
            });
        });
    </script>


</body>
<!--end::Body-->

</html>