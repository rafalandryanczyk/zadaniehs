<template>
  <div
    class="flex h-screen bg-gray-200 items-center justify-center mt-32 mb-32"
  >
    <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
      <div class="flex justify-center py-4"></div>

      <div class="flex justify-center">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Edit Form</h1>
        </div>
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold"
          >Name</label
        >
        <input
          v-model="form.name"
          class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
          type="text"
          placeholder="Name"
        />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold"
          >Culture</label
        >
        <input
          v-model="form.culture"
          class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
          type="text"
          placeholder="Culture"
        />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold"
          >Born</label
        >
        <input
          v-model="form.born"
          class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
          type="text"
          placeholder="Born"
        />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold"
          >Died</label
        >
        <input
          v-model="form.died"
          class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
          type="text"
          placeholder="Died"
        />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold"
          >Gender</label
        >
        <select
          v-model="form.gender"
          class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
        >
          <option>Male</option>
          <option>Famale</option>
        </select>
      </div>

      <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
        <inertia-link
          href="/characters"
          as="button"
          type="button"
          class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
        >
          Cancel
        </inertia-link>
        <button
          @click="update"
          class="w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
        >
          Edit
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import Layout from "../../Layouts/Layout";

export default {
  layout: Layout,
  props: {
    character: Object,
  },
  metaInfo: { title: "Edit" },
  data() {
    return {
      form: {},
    };
  },
  methods: {
    update() {
      this.form.put("/characters/update");
    },
  },
  mounted() {
    this.form = this.$inertia.form(this.character);
  },
};
</script>
