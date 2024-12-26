function fetchLeaveHistory() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../ajax/fetch_history.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const historyData = JSON.parse(this.responseText);
            const historyContainer = document.getElementById("historyContainer");
            historyContainer.innerHTML = ""; // Clear existing data

            historyData.forEach((record) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${record.leave_type}</td>
                    <td>${record.reason}</td>
                    <td>${record.status}</td>
                    <td>${record.requested_at}</td>
                `;
                historyContainer.appendChild(row);
            });
        }
    };
    xhr.send();
}

// Initial fetch
fetchLeaveHistory();
