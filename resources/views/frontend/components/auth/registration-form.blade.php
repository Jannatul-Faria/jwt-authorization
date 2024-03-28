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
        <div class="col-md-5 col-lg-5 center-screen">
            <div class="card animated fadeIn w-120 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-12 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" />
                            </div>
                            <div class="col-md-12 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile" />
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()"
                                    class="btn mt-3 w-120  bg-gradient-info">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function onRegistration() {
        let email = document.getElementById('email').value;
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast('email is requeired');
        } else if (firstName.length === 0) {
            errorToast('First Name requeired');
        } else if (lastName.length === 0) {
            errorToast('Last Name requeired');
        } else if (mobile.length === 0) {
            errorToast('Mobile is requeired');
        } else if (password.length === 0) {
            errorToast('Password is requeired');
        } else {
            showLoader();
            let res = await axios.post("registration", {
                email: email,
                firstName: firstName,
                lastName: lastName,
                mobile: mobile,
                password: password
            })
            hideLoader();
            if (res.status === 200 && res.data['status'] === 'Success') {
                successToast(res.data['message']);
                setTimeout(function() {
                    window.location.href = "/login"
                }, 2000)
            } else {
                errorToast(res.data['message'])
            }


        }
    }
</script>
