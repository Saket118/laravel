<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add User</title>
</head>
<body>
        @include('include.header')
<!-- Add User Card -->
<div class="container min-vh-100 d-flex justify-content-center align-items-center">

    <div class="card shadow p-4 w-100" style="max-width: 750px;">

        <h4 class="text-center mb-4">Add New User</h4>

        <form id="addUserForm">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control"
                       placeholder="Enter name"
                       required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control"
                       placeholder="Enter email"
                       required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>
            </div>

            <button type="button" onclick="Create();" class="btn btn-primary w-100">
                Add User
            </button>

        </form>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
     $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     const baseUrl = "{{ url('/') }}";
    function Create(){
const name = document.getElementById("name").value;
const email = document.getElementById("email").value;
const password = document.getElementById("password").value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if(name== ""){
    alert("name is required")
}
if(email== ""){
    alert("email is required")
}
 else if (!emailPattern.test(email)) {
            alert('Please enter a valid email');
        }

if(password== ""){
    alert("password is required")
}
 $.ajax({
url: baseUrl + '/Create_user',
  type: 'POST',
    data: {
        name: name,
        email: email,
        password: password
    },

    dataType: 'json',

    success: function (response) {
        if (response.status) {
            alert(response.message);
             window.location.href = '/dashboard';
        }
        else {
            alert(response.message);
        }
    },

    error: function (xhr, status, error) {
        if (callback) {
            callback(null, xhr.responseJSON || error);
        }
    }
     });


    }
   
</script>
</body>
</html>
