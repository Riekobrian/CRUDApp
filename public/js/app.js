// // Global variables
// let tasks = [];
// const taskModal = new bootstrap.Modal(document.getElementById("taskModal"));

// // Load tasks
// async function loadTasks() {
//   const response = await fetch("api.php");
//   const data = await response.json();
//   if (data.success) {
//     tasks = data.data;
//     renderTasks();
//   }
// }

// // Render tasks
// function renderTasks() {
//   const taskList = document.getElementById("taskList");
//   taskList.innerHTML = tasks
//     .map(
//       (task) => `
//         <div class="col-md-4 mb-4">
//             <div class="card task-card priority-${task.priority.toLowerCase()}">
//                 <div class="card-body">
//                     <h5 class="card-title">${task.title}</h5>
//                     <p class="card-text">${task.description}</p>
//                     <div class="d-flex justify-content-between align-items-center">
//                         <span class="badge bg-info">${task.status}</span>
//                         <span class="badge bg-${getPriorityColor(
//                           task.priority
//                         )}">${task.priority}</span>
//                     </div>
//                     <div class="mt-3">
//                         <button class="btn btn-sm btn-primary" onclick="editTask(${
//                           task.id
//                         })">
//                             <i class="fas fa-edit"></i>
//                         </button>
//                         <button class="btn btn-sm btn-danger" onclick="deleteTask(${
//                           task.id
//                         })">
//                             <i class="fas fa-trash"></i>
//                         </button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `
//     )
//     .join("");
// }

// // Get priority color
// function getPriorityColor(priority) {
//   switch (priority) {
//     case "High":
//       return "danger";
//     case "Medium":
//       return "warning";
//     case "Low":
//       return "success";
//     default:
//       return "secondary";
//   }
// }

// // Save task
// async function saveTask() {
//   const taskId = document.getElementById("taskId").value;
//   const task = {
//     title: document.getElementById("title").value,
//     description: document.getElementById("description").value,
//     status: document.getElementById("status").value,
//     priority: document.getElementById("priority").value,
//   };

//   const method = taskId ? "PUT" : "POST";
//   if (taskId) task.id = taskId;

//   const response = await fetch("api.php" + (taskId ? `?id=${taskId}` : ""), {
//     method: method,
//     headers: { "Content-Type": "application/json" },
//     body: JSON.stringify(task),
//   });

//   const data = await response.json();
//   if (data.success) {
//     taskModal.hide();
//     loadTasks();
//     resetForm();
//   }
// }

// // Edit task
// function editTask(id) {
//   const task = tasks.find((t) => t.id == id);
//   if (task) {
//     document.getElementById("taskId").value = task.id;
//     document.getElementById("title").value = task.title;
//     document.getElementById("description").value = task.description;
//     document.getElementById("status").value = task.status;
//     document.getElementById("priority").value = task.priority;
//     taskModal.show();
//   }
// }

// // Delete task
// async function deleteTask(id) {
//   if (confirm("Are you sure you want to delete this task?")) {
//     const response = await fetch(`api.php?id=${id}`, {
//       method: "DELETE",
//     });
//     const data = await response.json();
//     if (data.success) {
//       loadTasks();
//     }
//   }
// }

// // Reset form
// function resetForm() {
//   document.getElementById("taskForm").reset();
//   document.getElementById("taskId").value = "";
// }

// // Event listeners
// document.getElementById("saveTask").addEventListener("click", saveTask);
// document
//   .getElementById("taskModal")
//   .addEventListener("hidden.bs.modal", resetForm);

// // Initial load
// loadTasks();

// Global variables
let tasks = [];
const taskModal = new bootstrap.Modal(document.getElementById("taskModal"));

// Load tasks
async function loadTasks() {
  const response = await fetch("http://localhost/modern-crud/public/api.php");
  const data = await response.json();
  if (data.success) {
    tasks = data.data;
    renderTasks();
  }
}

// Render tasks
function renderTasks() {
  const taskList = document.getElementById("taskList");
  taskList.innerHTML = tasks
    .map(
      (task) => `
        <div class="col-md-4 mb-4">
            <div class="card task-card priority-${task.priority.toLowerCase()}">
                <div class="card-body">
                    <h5 class="card-title">${task.title}</h5>
                    <p class="card-text">${task.description}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info">${task.status}</span>
                        <span class="badge bg-${getPriorityColor(
                          task.priority
                        )}">${task.priority}</span>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-primary" onclick="editTask(${
                          task.id
                        })">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTask(${
                          task.id
                        })">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `
    )
    .join("");
}

// Get priority color
function getPriorityColor(priority) {
  switch (priority) {
    case "High":
      return "danger";
    case "Medium":
      return "warning";
    case "Low":
      return "success";
    default:
      return "secondary";
  }
}

// Save task
async function saveTask() {
  const taskId = document.getElementById("taskId").value;
  const task = {
    title: document.getElementById("title").value,
    description: document.getElementById("description").value,
    status: document.getElementById("status").value,
    priority: document.getElementById("priority").value,
  };

  const method = taskId ? "PUT" : "POST";
  if (taskId) task.id = taskId;

  const response = await fetch("http://localhost/modern-crud/public/api.php", {
    method: method,
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(task),
  });

  const data = await response.json();
  if (data.success) {
    taskModal.hide();
    loadTasks();
    resetForm();
  }
}

// Edit task
function editTask(id) {
  const task = tasks.find((t) => t.id == id);
  if (task) {
    document.getElementById("taskId").value = task.id;
    document.getElementById("title").value = task.title;
    document.getElementById("description").value = task.description;
    document.getElementById("status").value = task.status;
    document.getElementById("priority").value = task.priority;
    taskModal.show();
  }
}

// Delete task
async function deleteTask(id) {
  if (confirm("Are you sure you want to delete this task?")) {
    const response = await fetch(
      `http://localhost/modern-crud/public/api.php?id=${id}`,
      {
        method: "DELETE",
      }
    );
    const data = await response.json();
    if (data.success) {
      loadTasks();
    }
  }
}

// Reset form
function resetForm() {
  document.getElementById("taskForm").reset();
  document.getElementById("taskId").value = "";
}

// Event listeners
document.getElementById("saveTask").addEventListener("click", saveTask);
document
  .getElementById("taskModal")
  .addEventListener("hidden.bs.modal", resetForm);

// Initial load
loadTasks();
