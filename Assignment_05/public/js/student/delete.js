document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete-student");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const studentName = button.getAttribute("data-student-name");
            const formAction = button.getAttribute("data-action");

            document.getElementById("delete_student_name").innerText =
                studentName;

            const modalForm = document.querySelector(
                "#studentdeleteModal form"
            );
            if (modalForm) {
                modalForm.setAttribute("action", formAction);
            }

            $("#studentdeleteModal").modal("show");
        });
    });
});
