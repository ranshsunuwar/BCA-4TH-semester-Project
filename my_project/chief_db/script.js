// Menu toggle functionality
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelector('.menu-item.active').classList.remove('active');
        this.classList.add('active');
    });
});

// Approval handling
document.querySelectorAll('.btn-approve, .btn-reject').forEach(button => {
    button.addEventListener('click', function() {
        const action = this.classList.contains('btn-approve') ? 'approve' : 'reject';
        const row = this.closest('tr');
        const hodName = row.querySelector('td:nth-child(2)').textContent;
        
        if(confirm(`Are you sure you want to ${action} leave request from ${hodName}?`)) {
            alert(`Leave request ${action}d successfully!`);
        }
    });
});