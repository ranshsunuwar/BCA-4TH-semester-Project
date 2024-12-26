function fetchNotifications() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../ajax/notifications.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const notifications = JSON.parse(this.responseText);
            const notificationContainer = document.getElementById("notificationContainer");
            notificationContainer.innerHTML = ""; // Clear existing notifications

            notifications.forEach((notification) => {
                const item = document.createElement("li");
                item.textContent = notification.message;
                notificationContainer.appendChild(item);
            });
        }
    };
    xhr.send();
}

// Call fetchNotifications every 30 seconds
setInterval(fetchNotifications, 30000);
fetchNotifications(); // Initial call
