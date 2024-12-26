function fetchAttendance() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../ajax/fetch_attendance.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const attendanceData = JSON.parse(this.responseText);
            const attendanceContainer = document.getElementById("attendanceContainer");
            attendanceContainer.innerHTML = ""; // Clear existing data

            attendanceData.forEach((record) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${record.date}</td>
                    <td>${record.status}</td>
                `;
                attendanceContainer.appendChild(row);
            });
        }
    };
    xhr.send();
}

// Initial fetch
fetchAttendance();
