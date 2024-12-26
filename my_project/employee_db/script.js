// Toggle active menu item
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelector('.menu-item.active').classList.remove('active');
        this.classList.add('active');
    });
});

// Handle leave request form submission
document.getElementById('leaveRequestForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add form submission logic here
    alert('Leave request submitted successfully!');
});