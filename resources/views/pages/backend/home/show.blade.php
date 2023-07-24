@extends('layout.app')

@section('title', 'User Info')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12 mt-3">
                <div class="card card-body" id="userInformation">
                    <h4 class="text-center">User Information</h4>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        async function userInfoShow() {
            let email = sessionStorage.getItem('email');
            if (email) {
                const response = await axios.get('/user-info-show/' + email);
                console.log(response);
                if (response.status === 200 && response.data['status'] === 'success') {
                    let user = response.data.user;
                    document.getElementById("userInformation").innerHTML += (`<p>Name: ${user.name}</p>
                    <p>Email: ${user.email}</p>
                    <p>User Role: ${user.role}</p>`);
                } else {
                    errorToast(response.data['message']);
                }
            } else {
                window.location.href = "/admin/home";
            }
        }
        userInfoShow();
    </script>
@endsection
