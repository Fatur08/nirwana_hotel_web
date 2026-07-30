/*
|--------------------------------------------------------------------------
| Login Page Script
|--------------------------------------------------------------------------
|
| File ini digunakan untuk:
| - Show / Hide Password
| - Loading Button Login
| - Auto Close Alert
|
*/

/*
|--------------------------------------------------------------------------
| Show / Hide Password
|--------------------------------------------------------------------------
*/

const password = document.getElementById("password");

const togglePassword = document.getElementById("togglePassword");

const eyeIcon = document.getElementById("eyeIcon");

if (password && togglePassword && eyeIcon) {

    togglePassword.addEventListener("click", function () {

        if (password.type === "password") {

            password.type = "text";

            eyeIcon.classList.remove("bi-eye");

            eyeIcon.classList.add("bi-eye-slash");

        } else {

            password.type = "password";

            eyeIcon.classList.remove("bi-eye-slash");

            eyeIcon.classList.add("bi-eye");

        }

    });

}



/*
|--------------------------------------------------------------------------
| Loading Button Login
|--------------------------------------------------------------------------
*/

const loginForm = document.getElementById("loginForm");

const btnLogin = document.getElementById("btnLogin");

const btnText = document.getElementById("btnText");

if (loginForm && btnLogin && btnText) {

    loginForm.addEventListener("submit", function () {

        btnLogin.disabled = true;

        btnText.innerHTML = `

            <span class="spinner-border spinner-border-sm me-2"></span>

            Sedang Masuk...

        `;

    });

}



/*
|--------------------------------------------------------------------------
| Auto Close Alert
|--------------------------------------------------------------------------
*/

const alertBox = document.querySelector(".alert");

if (alertBox) {

    setTimeout(function () {

        alertBox.classList.remove("show");

        setTimeout(function () {

            alertBox.remove();

        }, 300);

    }, 4000);

}