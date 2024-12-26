function submitLeaveRequest(formData) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../ajax/leave_request.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            alert(response.message);
            if (response.success) location.reload();
        }
    };
    xhr.send(formData);
}
