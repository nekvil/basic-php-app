document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('authForm').addEventListener('submit', function(event) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (username === '' || password === '') {
            event.preventDefault();

            const errorMessage = document.getElementById('errorMessage');
            if (!errorMessage) {
                const errorMessageHTML = `
                    <div id="errorMessage" class="alert alert-dark alert-dismissible fade show" role="alert">
                        Please fill in all fields.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                document.getElementById('authForm').insertAdjacentHTML('beforeend', errorMessageHTML);
            }
        }
    });
});
