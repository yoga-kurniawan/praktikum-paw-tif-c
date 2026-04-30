function updateClock() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    document.getElementById('clock').textContent = `${String(hours).padStart(2, '0')}:${minutes}:${seconds}`;
    
    const body = document.body;
    const status = document.getElementById('greeting');

    if (hours > 0 && hours < 11) {
        body.className = 'pagi';
        status.textContent = "Selamat Pagi";
    } else if (hours >= 11 && hours < 14) {
        body.className = 'siang';
        status.textContent = "Selamat Siang";
    } else if (hours >= 14 && hours < 18) {
        body.className = 'sore';
        status.textContent = "Selamat Sore";
    } else {
        body.className = 'malam';
        status.textContent = "Selamat Malam";
    }
}

setInterval(updateClock, 1000);
updateClock();