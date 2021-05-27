<template>
  <div
    class="max-w-lg max-w-xs bg-blue-800 shadow-2xl rounded-lg mx-auto text-center py-12 mt-4 rounded-xl"
  >
    <h1 class="text-gray-200 text-center font-extrabold -mt-3 text-3xl">
      Welcome
    </h1>
    <div class="container py-5 max-w-md mx-auto">
      <form method="POST" @submit.prevent="login">
        <div class="mb-4">
          <input
            v-model="form.email"
            placeholder="Username"
            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="username"
            type="text"
          />
          <div
            v-if="form.errors.email"
            class="bg-red-100 border border-red-400 text-red-700 px-4 rounded relative mt-3"
            role="alert"
          >
            <span class="block sm:inline">{{ form.errors.email }}</span>
          </div>
        </div>
        <div class="mb-6">
          <input
            placeholder="Password"
            v-model="form.password"
            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password"
            type="password"
          />
          <div
            v-if="form.errors.password"
            class="bg-red-100 border border-red-400 text-red-700 px-4 rounded relative"
            role="alert"
          >
            <span class="block sm:inline">{{ form.errors.password }}</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
          >
            Sign In
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "../../Layouts/Layout";

export default {
  layout: Layout,
  metaInfo: { title: "Login" },
  data() {
    return {
      form: this.$inertia.form({
        email: "admin@admin.com",
        password: "password",
      }),
    };
  },
  methods: {
    login() {
      this.form.post("login");
    },
  },
};
</script>
