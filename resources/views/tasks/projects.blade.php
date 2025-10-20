<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manage Projects | Kiran</title>
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
                            <h3 class="mb-0">Projects</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item active" aria-current="page">Tasks Management</li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Projects</li>
                            </ol>
                            </ol>
                        </div>

                        <div class="col-12">
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
                        <form action="{{ url('tasks/addproject') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4 col-sm-12 mb-2">
                                <h1 class="modal-title fs-5" id="newFTypeModalLabel">Add New Project</h1>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter Title for Project">
                                </div>
                                @error('projectName')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                                <button type="submit" id="" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <div class="col-8 col-sm-12 col-md-9 mt-2">
                            @if(!empty($projects))
                            <table class="table table-bordered" role="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" scope="col">#</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($projects as $tkey => $project)
                                    <tr class="align-middle">
                                        <td>{{ $tkey+1 }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td><button class="btn btn-sm text-bg-primary" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}"><i class="bi bi-pencil"></i></button> &nbsp; <button class="btn btn-sm text-bg-danger btnDeleteProject" data-tid="{{ $project->id }}"><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    
                                    <form action="{{ url('tasks/updateproject') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Modal -->
                                        <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="newProjectModalLabel">Edit Project</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control editProjectName" name="editProjectName" placeholder="Enter Title for Project" value="{{ $project->name }}">
                                                        <input type="hidden" name="projectId" value="{{ $project->id }}">
                                                    </div>
                                                    @error('editProjectName')
                                                        <div class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="" class="btn btn-primary">Submit</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    </form>

                                    @endforeach
                                </tbody>
                            </table>
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

    <script>
	let url = "{{ url('cms/addfruittype') }}";
	let curUrl = "{{ url('cms/fruit-types') }}";
	$(document).ready(function () {
        // add fruit type
		$('#btnAddFruitType').on('click', function (e) {
			$.ajax({
				url: url,
				method: 'POST',
				data: {
                    'fruitType': $("#fruitType").val().trim(),
					_token: $('meta[name="csrf-token"]').attr('content')
                },
				success: function (response) {
					// You can return JSON from controller
					if(response.status) {
						alert(response.message);
						window.location.href = curUrl;
					}
				},
				error: function (xhr) {
					alert('Something went wrong!');
					console.log(xhr.responseText);
				}
			});
		});

        // edit fruit type
        $(document).on("click",".btnEditFruitType",function() {
	        let url = "{{ url('cms/updatefruittype') }}";
            let typeId = $(this).data('tid');
            let fruitType = $(".editFruitType"+typeId).val().trim();
			$.ajax({
				url: url,
				method: 'POST',
				data: {
                    'fruitType': fruitType,
                    'typeId': typeId,
					_token: $('meta[name="csrf-token"]').attr('content')
                },
				success: function (response) {
					// You can return JSON from controller
					if(response.status) {
						alert(response.message);
						window.location.href = curUrl;
					}
				},
				error: function (xhr) {
					alert('Something went wrong!');
					console.log(xhr.responseText);
				}
			});
		});

        // delete project
        $(document).on("click",".btnDeleteProject",function() {
	        let url = "{{ url('tasks/deleteproject') }}";
            let projectId = $(this).data('pid');
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
                        success: function (response) {
                            // You can return JSON from controller
                            if(response.status=='success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                }).then((result) => {
                                    window.location.href = curUrl;
                                });
                            }
                            else {
                                Swal.fire({
                                    title: "An error occured!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr) {
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