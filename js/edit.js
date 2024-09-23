document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[name="edit"]');

    form.addEventListener('submit', function (e) {
        const name = document.getElementById('name').value;
        const age = document.getElementById('age').value;
        const email = document.getElementById('email').value;
        const position = document.getElementById('position').value;

        // Validate form fields
        if (!name || !age || !email || !position) {
            e.preventDefault();  // Prevent form submission
            alert("All fields are required.");
        } else if (age < 18) {
            e.preventDefault();
            alert("Age must be at least 18.");
        } else {
            alert("Form submitted successfully!");
        }
    });
});
