function validateLogin() {
    const nric = document.getElementById('nric').value.trim();
    const pwd = document.getElementById('password').value.trim();
    if (!nric || !pwd) {
        alert('Please fill in all fields.');
        return false;
    }
    return true;
}

function validatePassword() {
    const o = document.getElementById('old_password').value;
    const n = document.getElementById('new_password').value;
    const c = document.getElementById('confirm_password').value;
    if (!o || !n || !c) {
        alert('All fields are required.');
        return false;
    }
    if (n.length < 6) {
        alert('New password must be at least 6 characters.');
        return false;
    }
    if (n !== c) {
        alert('Passwords do not match.');
        return false;
    }
    return true;
}

function validateStudent() {
    const name = document.getElementById('name').value.trim();
    const ic = document.getElementById('ic').value.trim();
    const marks = document.getElementById('marks').value;
    if (!name || !ic || marks === '') {
        alert('Please fill in all fields.');
        return false;
    }
    if (marks < 0 || marks > 100) {
        alert('Marks must be between 0 and 100.');
        return false;
    }
    return true;
}