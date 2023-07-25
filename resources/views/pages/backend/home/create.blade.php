@extends('layout.app')

@section('title', 'User Create')

@section('content')
    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-4">
                <div class="card card-body">
                    <h4 class="text-center text-muted">User Created</h4>
                    <div class="form-group pt-2 pb-3">
                        <input type="text" id="name" class="form-control" placeholder="Enter User Name">
                    </div>
                    <div class="form-group pb-3">
                        <input type="email" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group pb-3">
                        <input type="password" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <button type="button" onclick="createUser()" class="btn btn-dark btn-sm w-100">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        async function createUser() {
            let name = document.getElementById("name").value,
                email = document.getElementById("email").value,
                password = document.getElementById("password").value;

            if (name.length === 0) {
                    errorToast("Please enter user name?");
            } else if (email.length === 0) {
                    errorToast("Please enter user email address?");
            } else if (password.length === 0) {
                    errorToast("Please enter user password?");
            } else {
                const response = await axios.post("/user-create", {
                    name: name,
                    email: email,
                    password: password
                });
                if (response.status === 200 && response.data['status'] === 'success') {
                    successToast(response.data['message'])
                    setTimeout(() => {
                        window.location.href = "/admin/home";
                    }, 2000);
                } else {
                    errorToast(response.data['message']);
                }
            }
        }
    </script>
@endsection
