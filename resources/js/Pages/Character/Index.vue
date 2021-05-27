<template>
  <div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
      <div>
        <h2 class="text-2xl font-semibold leading-tight">Characters</h2>
      </div>
      <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
          <div class="relative">
            <select
              v-model="searchForm.gender"
              @change="onSearch()"
              class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500"
            >
              <option value="">All</option>
              <option value="Female">Female</option>
              <option value="Male">Male</option>
            </select>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </div>
          </div>
        </div>
        <div class="block relative">
          <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
              <path
                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"
              ></path>
            </svg>
          </span>
          <input
            v-model="searchForm.name"
            placeholder="Search by name"
            @input="onSearch()"
            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
          />
        </div>
      </div>
      <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
          <table class="min-w-full leading-normal">
            <thead>
              <tr>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  ID
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Name
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Gender
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Born
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Died
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Titles
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="character in characters.data" :key="character.id">
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {{ character.id }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {{ character.name }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {{ character.gender }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {{ character.born }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {{ character.died }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <ul v-if="character.titles.length > 0">
                    <li v-for="title in character.titles" :key="title.id">
                      "{{ title.name }}"
                    </li>
                  </ul>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <inertia-link
                    :href="`/characters/edit/` + character.id"
                    as="button"
                    type="button"
                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded"
                  >
                    Edit
                  </inertia-link>
                </td>
              </tr>
            </tbody>
          </table>
          <pagination class="mt-6" :data="characters" :request="request" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Pagination from "../../components/pagination";
import Layout from "../../Layouts/Layout";

export default {
  layout: Layout,
  components: {
    Pagination,
  },
  props: {
    characters: Object,
    request: Object,
  },
  metaInfo: { title: "Postacie" },
  data() {
    return {
      searching: false,
      searchForm: {
        gender: this.search?.gender || "",
        name: this.search?.name || "",
      },
    };
  },
  methods: {
    onSearch() {
      this.searching = true;
      this.doSearch();
    },
    doSearch() {
      const query = Object.keys(this.searchForm)
        .map((key) => key + "=" + this.searchForm[key])
        .join("&");
      if (Object.keys(query).length > 0) {
        this.$inertia.get(
          "characters?" + query,
          {},
          {
            replace: true,
            preserveState: true,
            onFinish: () => {
              this.searching = false;
            },
          }
        );
      } else {
        this.clearSearch();
      }
    },
    clearSearch() {
      this.searching = true;
      this.$inertia.get(
        "characters",
        {
          remember: "forget",
        },
        {
          replace: true,
        }
      );
    },
  },
  mounted() {
    console.log(this.$route);
  },
};
</script>
