export const userService = {
    getUser() {
      return JSON.parse(localStorage.getItem("user"));
    },
  };
  