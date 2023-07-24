<div class="row justify-content-center" style="padding: 7rem 0 0 0;">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card">
            <h4 class="card-header">User Login</h4>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <button type="button" onclick="submitLogin()" class="btn btn-primary w-100 mt-2">Login</button>
                <div class="text-center py-2"><a href="">Create a new account?</a></div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        async function submitLogin() {
            let email = document.getElementById("email").value,
                password = document.getElementById("password").value;

            const response = await axios.post("/login", {
                email: email,
                password: password
            });
            if (response.status === 200 && response.data['status'] === 'success') {
                if(response.data['userRole'] === 'admin')
                {
                    window.location.href = "/admin/home";
                }else{
                    window.location.href = "/";
                }
            } else {
                errorToast(response.data['message']);
            }
        }
    </script>
@endsection