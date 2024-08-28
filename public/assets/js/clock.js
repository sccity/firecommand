document.addEventListener('DOMContentLoaded', function () {
    function updateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: true
        };
        const formattedTime = now.toLocaleString('en-US', options).replace(',', ' -');
        document.getElementById('clock').textContent = formattedTime;
    }

    setInterval(updateTime, 1000);
    updateTime(); // Call immediately to show time on page load
});