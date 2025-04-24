let timerInterval;

function startChallenge() {
    document.querySelector('.start-button').style.display = 'none';
    document.getElementById('captcha-container').style.display = 'flex';
    fetchCaptcha();
    startTimer(4);
}

function fetchCaptcha() {
    fetch('/generate-captcha')
        .then(response => response.text())
        .then(data => {
            const container = document.getElementById('captcha-image-container');
            container.innerHTML = `<img src="../static/captchas/${data}" alt="CAPTCHA">`;
        })
        .catch(error => console.error('Error fetching CAPTCHA:', error));
}

function startTimer(seconds) {
    let timeLeft = seconds;
    document.getElementById('timer').textContent = `Time left: ${timeLeft}s`;
    timerInterval = setInterval(() => {
        timeLeft -= 1;
        document.getElementById('timer').textContent = `Temps restant : ${timeLeft}s`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Le temps est écoulé !\nIl faudra être plus rapide si tu souhaites t\'en sortir !');
            window.location.reload();
        }
    }, 1000);
}

function validateCaptcha() {
    clearInterval(timerInterval);
    const userInput = document.getElementById('captcha-input').value;

    const params = new URLSearchParams();
    params.append('captcha', userInput);

    fetch('/validate-captcha', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params.toString(),
    })
        .then(response => response.text())
        .then(data => {
            const mainContainer = document.getElementById('main-container');
            const resultContainer = document.getElementById('result-container');
            const resultText = document.getElementById('result-text');

            mainContainer.style.display = 'none';
            resultText.innerHTML = data;
            resultContainer.style.display = 'flex';
            if (data.toLowerCase().includes('incorrect')) {
                setTimeout(() => window.location.href = '/', 2000);
            }
        })
        .catch(error => console.error('Error validating CAPTCHA:', error));
}
