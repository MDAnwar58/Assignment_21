<div class="row justify-content-center" style="padding: 3rem 0 0 0;">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card">
            <h4 class="card-header text-center">User Register</h4>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <button type="button" onclick="submitRegister()" class="btn btn-primary w-100 mt-2">Login</button>
                <div class="text-center py-2"><a href="{{ route('login.page') }}">Already Have an account?</a></div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        async function submitRegister() {
            let name = document.getElementById("name").value,
                email = document.getElementById("email").value,
                password = document.getElementById("password").value;

            const response = await axios.post("/register", {
                name: name,
                email: email,
                password: password
            });
            if (response.status === 200 && response.data['status'] === 'success') {
                setTimeout(() => {
                    successToast(response.data['message'])
                }, 2000);
                window.location.href = "/login";
            } else {
                errorToast(response.data['message']);
            }
        }
    </script>
@endsection
