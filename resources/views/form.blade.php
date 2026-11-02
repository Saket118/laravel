<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>form</title>
    @include('include.header')
</head>
<body>
  <div class="bg-primary vh-100 d-flex justify-content-center align-items-center">
    <div class="card" style="width: 18rem;">
  <div class="card-body">
    <form>
      <!-- <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div> -->
      
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email">
      </div>
      
      <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" id="pass">
      </div>
      
      <button type="button" onclick="formData()" class="btn btn-primary w-100">Submit</button>
    </form>
  </div>
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
    function formData(){
      // let name = document.getElementById("name").value;
      let email = document.getElementById("email").value;
      let pass = document.getElementById("pass").value;

 $.ajax({
    url: baseUrl + '/register',
    type: 'POST',

    data: {
        // name: name,
        email: email,
        pass: pass
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