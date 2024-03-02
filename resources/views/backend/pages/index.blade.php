@extends('backend.layouts.master')

{{-- title --}}
@section('title')
    {{ config('app.name') }} | Home
@endsection
{{-- title --}}

{{-- main content --}}
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20" class="me-1">
                        <h5 class="me-auto my-0">Geeks N Weebs</h5>
                        <small>Just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Hello, {{ Auth::user()->name }}
                    </div>
                </div><!--end toast-->
            </div> <!-- end col -->

            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Tasks</h4>
                            <button id="addNewTaskBtn" class="btn btn-sm btn-soft-primary"><i
                                    class="fas fa-plus me-2"></i>New Task</button>
                        </div>
                        <div id="tasks_view" class="my-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- main content --}}

{{-- custom-modals --}}
@section('custom-modals')
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" class="form-control" id="task" name="task" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addNewTask()">Save task</button>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- custom-modals --}}



{{-- page-specific-scripts-cdns --}}
@section('page-specific-scripts-cdns')
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
@endsection
{{-- page-specific-scripts-cdns --}}

{{-- custom-scripts --}}
@section('custom-scripts')
    <script>
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ $errors->first() }}";
        // session messages
        jQuery(function($) {
            // Preloader for ajax request
            $(document).ajaxSend(function() {
                $("#overlay").fadeIn(150);
            });

            // success message
            if (successMessage) {
                Swal.mixin({
                    toast: !0,
                    position: "top-end",
                    showConfirmButton: !1,
                    timer: 3e3,
                    timerProgressBar: !0,
                    onOpen: function(t) {
                        t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener(
                            "mouseleave",
                            Swal.resumeTimer)
                    }
                }).fire({
                    icon: "success",
                    title: successMessage,
                })
            }
            // error message
            if (errorMessage) {
                Swal.fire({
                    title: "Error!",
                    text: errorMessage,
                    icon: "error"
                });
            }

            // Get all tasks
            getTasks();

            // Add new task
            $('#addNewTaskBtn').on('click', function() {
                $('#addTaskModal').modal('show');
            });

        });

        // Get all tasks
        function getTasks() {
            // Ajax request for getting tasks
            $.ajax({
                url: "{{ route('api.task.index') }}",
                type: "GET",
                headers: {
                    'API_KEY': 'helloatg'
                },
                data: {
                    'user_id': '{{ Auth::user()->id }}',
                },
                success: function(response) {
                    if (response.status === 1) {
                        var tasks = response.tasks;
                        if (tasks.length === 0) {
                            var html =
                                '<div class="alert alert-danger" role="alert">No tasks found. Please add some tasks.</div>';
                        } else {
                            var html =
                                '<div class="table-responsive"><table class="table table-nowrap table-centered table-hover table-borderless"><thead><tr><th scope="col">S No.</th><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Created At</th><th scope="col" class="text-center">Action</th></tr></thead><tbody>';
                            $.each(tasks, function(key, task) {
                                var status = task.status === 'done' ?
                                    '<span class="badge bg-success">Completed</span>' :
                                    '<span class="badge bg-danger">Pending</span>';
                                let markTaskDone =
                                    `<button onclick="markTaskDone(${task.id})" class="btn btn-sm btn-soft-success mx-2 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mark as done"><img width="18" height="18" src="https://img.icons8.com/flat-round/64/checkmark.png" alt="checkmark"/></button>`;
                                let markTaskPending =
                                    `<button onclick="markTaskPending(${task.id})" class="btn btn-sm btn-soft-warning mx-2 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mark as pending"><img width="18" height="18" src="https://img.icons8.com/color/48/clock--v1.png" alt="clock--v1"/></button>`;
                                let action = task.status === 'done' ? markTaskPending :
                                    markTaskDone;

                                action +=
                                    `<button onclick="deleteTask(${task.id})" class="btn btn-sm btn-soft-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete task"><img width="18" height="18" src="https://img.icons8.com/plasticine/100/filled-trash.png" alt="filled-trash"/></button>`;

                                html += '<tr><td>' + (key + 1) + '</td><td>' + task.task +
                                    '</td><td>' + status + '</td><td>' + task
                                    .created_at_human +
                                    '</td><td class="d-flex justify-content-center">' + action +
                                    '</td></tr>';
                            });
                            html += '</tbody></table></div>';
                        }
                        $('#tasks_view').html(html);
                    } else {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            }).always(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(
                        150
                    ); // Hide the preloader after the request is complete
                }, 500);
            });
        }

        // Add new task
        function addNewTask() {
            let task = $('#task').val();
            $.ajax({
                url: "{{ route('api.task.store') }}",
                type: "POST",
                headers: {
                    'API_KEY': 'helloatg'
                },
                data: {
                    'user_id': '{{ Auth::user()->id }}',
                    'task': task
                },
                success: function(response) {
                    if (response.status === 1) {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            onOpen: function(t) {
                                t.addEventListener("mouseenter", Swal.stopTimer), t
                                    .addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer)
                            }
                        }).fire({
                            icon: "success",
                            title: response.message,
                        })
                        $('#task').val(''); // Clear the input field
                        getTasks();
                        $('#addTaskModal').modal('hide');
                    } else {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            }).always(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(
                        150
                    ); // Hide the preloader after the request is complete
                }, 500);
            });
        }

        // Mark task as done
        function markTaskDone(taskId) {
            $.ajax({
                url: "{{ route('api.task.updateStatus') }}",
                type: "POST",
                headers: {
                    'API_KEY': 'helloatg'
                },
                data: {
                    'task_id': taskId,
                    'status': 'done'
                },
                success: function(response) {
                    if (response.status === 1) {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            onOpen: function(t) {
                                t.addEventListener("mouseenter", Swal.stopTimer), t
                                    .addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer)
                            }
                        }).fire({
                            icon: "success",
                            title: response.message,
                        })
                        getTasks();
                    } else {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            }).always(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(
                        150
                    ); // Hide the preloader after the request is complete
                }, 500);
            });
        }

        // Mark task as pending
        function markTaskPending(taskId) {
            $.ajax({
                url: "{{ route('api.task.updateStatus') }}",
                type: "POST",
                headers: {
                    'API_KEY': 'helloatg'
                },
                data: {
                    'task_id': taskId,
                    'status': 'pending'
                },
                success: function(response) {
                    if (response.status === 1) {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            onOpen: function(t) {
                                t.addEventListener("mouseenter", Swal.stopTimer), t
                                    .addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer)
                            }
                        }).fire({
                            icon: "success",
                            title: response.message,
                        })
                        getTasks();
                    } else {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            }).always(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(
                        150
                    ); // Hide the preloader after the request is complete
                }, 500);
            });
        }

        // Delete task
        function deleteTask(taskId) {
            $.ajax({
                url: "{{ route('api.task.destroy') }}",
                type: "POST",
                headers: {
                    'API_KEY': 'helloatg'
                },
                data: {
                    'task_id': taskId
                },
                success: function(response) {
                    if (response.status === 1) {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            onOpen: function(t) {
                                t.addEventListener("mouseenter", Swal.stopTimer), t
                                    .addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer)
                            }
                        }).fire({
                            icon: "success",
                            title: response.message,
                        })
                        getTasks();
                    } else {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                }
            }).always(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(
                        150
                    ); // Hide the preloader after the request is complete
                }, 500);
            });
        }
    </script>
@endsection
{{-- custom-scripts --}}
