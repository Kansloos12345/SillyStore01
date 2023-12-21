function logout(event) {
    if (!confirm("Do you want to logout?")) {
        event.preventDefault();
    }
}

