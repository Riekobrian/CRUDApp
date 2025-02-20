document.addEventListener("DOMContentLoaded", function () {
  // Confirm before deleting a task
  document.querySelectorAll(".delete-task").forEach((button) => {
    button.addEventListener("click", (e) => {
      if (!confirm("Are you sure you want to delete this task?")) {
        e.preventDefault();
      }
    });
  });
});
