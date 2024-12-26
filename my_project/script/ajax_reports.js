function fetchReport(reportType) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `reports.php?report_type=${reportType}`, true);
    xhr.onload = function () {
        if (this.status === 200) {
            try {
                const data = JSON.parse(this.responseText);
                displayReport(data, reportType);
            } catch (e) {
                alert("Error fetching report data.");
            }
        }
    };
    xhr.send();
}

function displayReport(data, reportType) {
    const reportResults = document.getElementById("report_results");
    reportResults.innerHTML = "";

    if (reportType === "leave_summary") {
        let html = "<h2>Leave Summary</h2><table><tr><th>Leave Type</th><th>Count</th></tr>";
        data.forEach(item => {
            html += `<tr><td>${item.leave_type}</td><td>${item.count}</td></tr>`;
        });
        html += "</table>";
        reportResults.innerHTML = html;
    } else if (reportType === "employee_leave_history") {
        let html = "<h2>Employee Leave History</h2><table><tr><th>Employee Name</th><th>Leave Type</th><th>Status</th><th>Requested At</th><th>Reviewed At</th></tr>";
        data.forEach(item => {
            html += `<tr>
                <td>${item.username}</td>
                <td>${item.leave_type}</td>
                <td>${item.status}</td>
                <td>${item.requested_at}</td>
                <td>${item.reviewed_at}</td>
            </tr>`;
        });
        html += "</table>";
        reportResults.innerHTML = html;
    }
}
