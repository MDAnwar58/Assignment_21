@extends('layout.app')

@section('title', 'User Edit')

@section('content')

    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-4">
                <div class="card card-body">
                    <h4 class="text-center text-muted">User Update</h4>
                    <div class="form-group pt-2 pb-3">
                        <input type="text" id="name" class="form-control" placeholder="Enter User Name">
                    </div>
                    <div class="form-group pb-3">
                        <input type="email" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <button type="button" onclick="updateUser()" class="btn btn-dark btn-sm w-100">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        userInput();
        async function userInput() {
            let nameInput = document.getElementById("name"),
                emailInput = document.getElementById("email"),
                email = sessionStorage.getItem('email');

            const response = await axios.get("/user-get-edit/" + email);
            console.log(response);
            if (response.status === 200 && response.data['status'] === 'success') {
                let user = response.data.user;
                nameInput.value = user.name;
                emailInput.value = user.email;
            } else {
                errorToast(response.data['message']);
            }
        }

        async function updateUser() {
            let name = document.getElementById("name").value,
                email = document.getElementById("email").value;

            if (name.length === 0) {
                errorToast("Please enter user name?");
            } else if (email.length === 0) {
                errorToast("Please enter user email address?");
            } else {
                const response = await axios.post("/user-update", {
                    name: name,
                    email: email
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
