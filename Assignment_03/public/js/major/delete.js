document.addEventListener('DOMContentLoaded', function() {
    // Find all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete-major');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();  // Prevent default anchor action
            
            // Confirm before submitting
            const confirmDelete = confirm('Are you sure you want to delete this major?');
            
            if (confirmDelete) {
                const formId = button.getAttribute('data-form-id');
                const form = document.getElementById(formId);
                form.submit();
            }
        });
    });
});
