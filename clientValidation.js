document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");
    
    registrationForm.addEventListener("submit", function (e) {
        // Check all fields are filled
        const inputs = registrationForm.querySelectorAll("input[required]");
        for (let input of inputs) {
            if (!input.value.trim()) {
                alert("Please fill out all fields.");
                e.preventDefault();
                return;
            }
        }

        // Check email format
        const email = registrationForm.querySelector("input[type='email']").value;
        if (!/\S+@\S+\.\S+/.test(email)) {
            alert("Please enter a valid email address.");
            e.preventDefault();
            return;
        }

        // Password matching and criteria check
        const password = registrationForm.querySelector("input[name='password']").value;
        const confirmPassword = registrationForm.querySelector("input[name='confirm_password']").value;
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            e.preventDefault();
            return;
        }

        if (password.length < 8 || !/\d/.test(password) || !/[!@#$%^&*]/.test(password)) {
            alert("Password does not meet the complexity requirements.");
            e.preventDefault();
            return;
        }

        // Additional validation can be added here
    });
});
