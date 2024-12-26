// Define default credentials
const credentials = {
    'EMP101': {
        password: 'emp123',
        type: 'employee1',
        dashboard: 'employee_dashboard.php'
    },
    'ADM101': {
        password: 'hr123',
        type: 'hr1',
        dashboard: 'admin_dashboard.php'
    },
    'CHF101': {
        password: 'chief123',
        type: 'chief1',
        dashboard: 'chief_dashboard.php'
    }
};

function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function handleLogin(event) {
    event.preventDefault();
    
    const userId = document.getElementById('userId').value;
    const password = document.getElementById('password').value;

    // Check if user exists and password matches
    if (credentials[userId] && credentials[userId].password === password) {
        // Successful login - redirect to appropriate dashboard
        window.location.href = credentials[userId].dashboard;
    } else {
        alert('Invalid credentials. Please try again.');
    }
}