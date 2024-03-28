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
                    <h4>ENTER OTP CODE</h4>
                    <br />
                    <label>4 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text" />
                    <br />
                    <button onclick="VerifyOtp()" class="btn w-100 float-end bg-gradient-info">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function VerifyOtp() {
        let otp = document.getElementById('otp').value;

        if (otp.length === 0) {
            errorToast('Please enter 4 digit otp code')
        } else {
            showLoader();
            let res = await axios.post("verifyOtp", {
                otp: otp,
                email: sessionStorage.getItem('email')
            });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message'])
                sessionStorage.clear();
                setTimeout(function() {
                    window.location.href = "resetPassword";
                }, 1000)
            } else {
                errorToast(res.data['message'])
            }
        }
    }
</script>
