document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('login-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const logoutButton = document.getElementById('logout-button');


    fetch('session_handler.php')
        .then(response => response.json())
        .then(data => {
            if (data.user_name) {
                loginButton.textContent = data.user_name;
                loginButton.classList.add('logged-in');
                dropdownMenu.style.display = 'none';
            } else {
                loginButton.textContent = 'Увійти';
                loginButton.classList.remove('logged-in');
                loginButton.addEventListener('click', () => {
                    window.location.href = 'login.html';
                });
            }
        })
        .catch(error => console.error('Помилка перевірки авторизації:', error));

    loginButton.addEventListener('mouseover', () => {
        if (loginButton.classList.contains('logged-in')) {
            dropdownMenu.style.display = 'block';
        }
    });

    loginButton.addEventListener('mouseout', () => {
        setTimeout(() => {
            if (!dropdownMenu.matches(':hover')) {
                dropdownMenu.style.display = 'none';
            }
        }, 200);
    });

    dropdownMenu.addEventListener('mouseleave', () => {
        dropdownMenu.style.display = 'none';
    });


    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            fetch('logout.php')
                .then(() => {
                    loginButton.textContent = 'Увійти';
                    loginButton.classList.remove('logged-in');
                    dropdownMenu.style.display = 'none';
                    window.location.reload();
                })
                .catch(error => console.error('Помилка виходу:', error));
        });
    }
});
