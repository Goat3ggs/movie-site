
window.addEventListener('load', function () {
    const spinner = document.getElementById('spinner');
    if (spinner) {
        spinner.classList.add('hidden');
        setTimeout(() => {
            spinner.style.display = 'none'; // Elimină complet elementul după tranziție
        }, 500); // Durata în milisecunde trebuie să corespundă cu CSS-ul
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const runtimeElement = document.getElementById('runtime-text');
    const toggleButton = document.getElementById('toggle-runtime');

    if (runtimeElement && toggleButton) {
        let isMinutes = true; // Inițial afișăm minutele
        const runtimeText = runtimeElement.textContent.match(/\d+/)[0]; // Extragem minutele

        toggleButton.addEventListener('click', function () {
            if (isMinutes) {
                const hours = Math.floor(runtimeText / 60);
                const minutes = runtimeText % 60;
                runtimeElement.textContent = `Runtime: ${hours}h ${minutes}m`;
            } else {
                runtimeElement.textContent = `Runtime: ${runtimeText} minutes`;
            }
            isMinutes = !isMinutes; // Comutăm starea
        });
    }
});

let timeSpent = 0;

window.setInterval(function() {
    // Incrementăm timpul petrecut pe pagină
    timeSpent++;

    // Verificăm dacă elementul există
    const timeSpentElement = document.getElementById('time-spent');
    if (timeSpentElement) {
        timeSpentElement.innerHTML = `<br>You have been on this site for ${timeSpent} seconds.`;
    }

    // Dacă timpul ajunge la 60 secunde, afișăm un alert
    if (timeSpent === 60) {
        alert('You have been on this site for more than 1 minute. If you cannot find the information you are looking for, please contact the site administration.');
    }
}, 1000);  // Interval de 1 secundă