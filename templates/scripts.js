(function hideAlertMessage() {
    setTimeout(() => {
        const alert = document.getElementById('alert');
        alert.style.display = 'none';
    }, 3000);
})();