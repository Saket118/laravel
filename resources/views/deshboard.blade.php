
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .dashboard-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .dashboard-title {
            font-weight: 700;
            color: #212529;
        }

        .table thead th {
            white-space: nowrap;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="dashboard-title mb-1">Dashboard</h2>
                <p class="text-muted mb-0">Manage your users</p>
            </div>

            <button id="logoutBtn" class="btn btn-danger">
                Logout
            </button>
                
            
           
        </div>


        <!-- User Table -->
        <div class="dashboard-card">

        <div class=" d-flex justify-content-between">
            <h5 class="mb-4">User List</h5>
           <a href="AddUser" class="btn btn-primary"> Add User</a> 
           </div> 
           <div class="table-responsive">

                <table id="userTable" class="table table-bordered table-striped table-hover align-middle w-100">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>

                        </tr>
                    </thead>

            <tbody>

    @forelse($data as $get)

        <tr>
            <td>{{ $get->id }}</td>
            <td>{{ $get->name }}</td>
            <td>{{ $get->email }}</td>
             <td>{{ $get->password }}</td>

            <td>
                <a href="{{ url('/edit-user/'.$get->id) }}"
   class="btn btn-sm btn-primary">
    <i class="bi bi-pencil-square"></i> Edit
</a>

<form action="{{ route('delete.user', $get->id) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('Are you sure you want to delete this user?')">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i> Delete
    </button>

</form>

                <!-- <a href="{{ url('/delete-user/'.$get->id) }}"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Are you sure you want to delete this user?')">
    <i class="bi bi-trash"></i> Delete
</a> -->
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="4" class="text-center">
                No users found
            </td>
        </tr>

    @endforelse

</tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>


    <script>

        $(document).ready(function () {

            // Initialize DataTable
            $('#userTable').DataTable({

                pageLength: 5,

                lengthMenu: [5, 10, 25, 50],

                ordering: true,

                searching: true,

                responsive: true,

                language: {
                    search: "Search Users:",
                    lengthMenu: "Show _MENU_ users",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    emptyTable: "No users available"
                }

            });


            // Logout AJAX
            $('#logoutBtn').click(function () {

                $.ajax({

                    url: '/logout',

                    type: 'POST',

                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (response) {

                        alert(response.message);

                        window.location.href = '/form';

                    },

                    error: function (xhr) {

                        console.log(xhr.responseJSON);

                        alert('Logout failed. Please try again.');

                    }

                });

            });

        });

       


    </script>

</body>
</html>
