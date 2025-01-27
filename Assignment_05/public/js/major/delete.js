document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete-major");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const majorName = button.getAttribute("data-major-name");
            const formAction = button.getAttribute("data-action");

            document.getElementById("delete_major_name").innerText = majorName;

            const modalForm = document.querySelector("#deleteModal form");
            if (modalForm) {
                modalForm.setAttribute("action", formAction);
            }

            $("#deleteModal").modal("show");
        });
    });
});
