// Modern API client using async/await
// const api = {
//   async getTasks() {
//     const response = await fetch("/api/tasks");
//     if (!response.ok) throw new Error("Failed to fetch tasks");
//     return response.json();
//   },

//   async createTask(task) {
//     const response = await fetch("/api/tasks", {
//       method: "POST",
//       headers: { "Content-Type": "application/json" },
//       body: JSON.stringify(task),
//     });
//     if (!response.ok) throw new Error("Failed to create task");
//     return response.json();
//   },

  // More API methods...
// };



// const api = {
//   baseUrl: "/api/tasks",

//   async getTasks() {
//     const response = await fetch(this.baseUrl);
//     return handleResponse(response);
//   },

//   async createTask(task) {
//     const response = await fetch(this.baseUrl, {
//       method: "POST",
//       headers: { "Content-Type": "application/json" },
//       body: JSON.stringify(task),
//     });
//     return handleResponse(response);
//   },
// };

// async function handleResponse(response) {
//   if (!response.ok) {
//     const error = await response.json();
//     throw new Error(error.message || "Something went wrong");
//   }
//   return response.json();
// }








const api = {
  baseUrl: "http://localhost/modern-crud/public/api.php", // Ensure correct API path

  async getTasks() {
    const response = await fetch(this.baseUrl);
    return handleResponse(response);
  },

  async createTask(task) {
    const response = await fetch(this.baseUrl, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(task),
    });
    return handleResponse(response);
  },
};

async function handleResponse(response) {
  if (!response.ok) {
    const error = await response.json();
    throw new Error(error.message || "Something went wrong");
  }
  return response.json();
}
