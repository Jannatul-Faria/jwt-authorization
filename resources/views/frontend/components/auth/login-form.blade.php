<div class="container">
    <div class="header">
        <div class="row">
            <div class="col-md 4">
                <div class="float-end mt-3">
                    <span>
                        <a class="text-center ms-3 h6" href="{{ url('/') }}">Back </a>

                    </span>
                </div>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 animated fadeIn col-lg-6 center-screen">
            <div class="card w-60  p-2">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br />
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <input id="password" placeholder="User Password" class="form-control" type="password" />
                    <br />
                    <button onclick="SubmitLogin()" class="btn w-30 bg-gradient-info">Next</button>

                    <hr />

                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/registration') }}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/sendOtp') }}">Forget Password</a>
                        </span>
                    </div>
                    <br /> <br />


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function SubmitLogin() {

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast('email requeired');
        } else if (password.length === 0) {
            errorToast('password requeired');
        } else {
            showLoader();
            let res = await axios.post("login", {
                email: email,
                password: password
            });
            hideLoader()
            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                window.location.href = "/dashboard";
            } else {
                errorToast(res.data['message']);
            }


        }

    }
</script>
