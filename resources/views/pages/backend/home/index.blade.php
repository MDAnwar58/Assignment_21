@extends('layout.app')

@section('title', 'Admin Home')

@section('content')
    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-4">
                <div class="card card-body">
                    <h3 class="text-center">Welcome to admin panel</h3>
                    <div class="text-center">
                        <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pt-2">
                <a href="{{ route('create.user') }}" class="btn btn-dark">Create User</a>
            </div>
            <div class="col-md-12 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Role</th>
                                <th>Read/Unread</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="user_list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        getUser();
        async function getUser() {
            sessionStorage.removeItem('email');
            // let userList = document.getElementById("user_list");
            const response = await axios.get("/user-get");
            response.data.forEach((user, index) => {
                document.getElementById("user_list").innerHTML += (`<tr>
                                <td>${index + 1}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.role}</td>
                                <td>${user.is_read === 0 ? '<span class="text-danger">unread</span>' : '<span class="text-success">read</span>'}</td>
                                <td>
                                    <button type="button" onclick="userRead('${user.email}')" class="btn btn-info btn-sm">Read</button>    
                                    <button type="button" onclick="userEdit('${user.email}')" class="btn btn-primary btn-sm">Edit</button>    
                                    <button type="button" onclick="userDelete('${user.email}')" class="btn btn-danger btn-sm">Delete</button>    
                                </td>
                            </tr>`);
            });
        }

        async function userRead(email) {
            sessionStorage.setItem('email', email);
            const response = await axios.get('/user-read/' + email);
            if (response.status === 200 && response.data['status'] === 'success') {
                window.location.href = "/user-read-page";
            } else {
                errorToast(response.data['message']);
            }
        }

        async function userEdit(email) {
            sessionStorage.setItem('email', email);

            setTimeout(() => {
                window.location.href = "/user-edit-page";
            }, 2000);
        }
        async function userDelete(email) {
            const response = await axios.get("/user-delete/" + email);
            console.log(response);
            if (response.status === 200 && response.data['status'] === 'success') {
                successToast(response.data['message']);
                setTimeout(() => {
                    window.location.href = "/admin/home";
                }, 1000);
            } else {
                errorToast(response.data['message']);
            }
        }
    </script>
@endsection
