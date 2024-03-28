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
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br />
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <button onclick="VerifyEmail()" class="btn w-100 float-end bg-gradient-info">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function VerifyEmail() {
        let email = document.getElementById('email').value;

        if (email.length === 0) {
            errorToast('Email requried')
        } else {
            showLoader();
            let res = await axios.post("sendOtp", {
                email: email
            });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message'])
                sessionStorage.setItem('email', email);
                setTimeout(function() {
                    window.location.href = "otpVerify";
                }, 1000)
            } else {
                errorToast(res.data['message'])
            }
        }
    }
</script>
