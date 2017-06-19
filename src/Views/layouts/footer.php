        </div> <!-- col-md... -->
    </div> <!-- row -->
</div> <!-- container -->


<!-- Facebook Account Kit -->
<script>
    // initialize Account Kit with CSRF protection
    AccountKit_OnInteractive = function(){
        AccountKit.init(
            {
                appId:"<?=self::$fbAppId; ?>",
                state:"<?=self::$fbAppSecret; ?>",
                version:"<?=self::$fbAppApiVersion; ?>",
                fbAppEventsEnabled:true
            }
        );
    };

    // login callback
    function loginCallback(response) {
        if (response.status === "PARTIALLY_AUTHENTICATED") {
            // Send code to server to exchange for access token

            document.getElementById("code").value = response.code;
            document.getElementById("csrf").value = response.state;
            document.getElementById("login_success").submit();

        }
        else if (response.status === "NOT_AUTHENTICATED") {
            // handle authentication failure
        }
        else if (response.status === "BAD_PARAMS") {
            // handle bad parameters
        }
    }

    // phone form submission handler
    function smsLogin() {
        var countryCode = document.getElementById("country_code").value;
        var phoneNumber = document.getElementById("phone_number").value;
        AccountKit.login(
            'PHONE',
            {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
            loginCallback
        );
    }


    // email form submission handler
    function emailLogin() {
        var emailAddress = document.getElementById("email").value;
        AccountKit.login(
            'EMAIL',
            {emailAddress: emailAddress},
            loginCallback
        );
    }
</script>


<!-- jQuery -->
<script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>