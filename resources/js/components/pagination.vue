<template>
    <div
        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
        <span class="text-xs xs:text-sm text-gray-900">
            Showing {{ data.meta.from }} to {{ data.meta.to }} of {{ data.meta.total }} Entries
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <inertia-link v-if="data.links.prev !== null" :href="getPrevLink" as="button" type="button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                Prev
            </inertia-link>
            <button v-else disabled
                class="cursor-not-allowed text-sm bg-gray-200 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                Prev
            </button>
            <inertia-link v-if="data.links.next !== null" :href="getNextLink" method="get" as="button" type="button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                Next
            </inertia-link>
            <button v-else disabled
                class="cursor-not-allowed text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                Next
            </button>
        </div>
    </div>
</template>

<script>
export default {
  name: 'pagination',
  props: {
    data: Object,
    request: Object,
  },
  computed: {
      getPrevLink() {
          if (this.request) {
              this.request = Object.keys(this.request).filter(key => key !== "page").reduce((obj, key) => {
    obj[key] = this.request[key];
    return obj;
  }, {});
              const requestQuery = Object.keys(this.request).map(key => this.request[key] && key !== 'page' ? key + '=' + this.request[key] : null).join('&');
              return this.data.links.prev + '&' + requestQuery
          } else {
              return this.data.links.prev
          }
      },
      getNextLink() {
           if (this.request) {
               this.request = Object.keys(this.request).filter(key => key !== "page").reduce((obj, key) => {
    obj[key] = this.request[key];
    return obj;
  }, {});
              const requestQuery = Object.keys(this.request).map(key => this.request[key] && key !== 'page' ?  key + '=' + this.request[key] : null).join('&');
              return this.data.links.next + '&' + requestQuery
          } else {
              return this.data.links.next
          }
      }
  },
  mounted() {
     console.log(this.request)
  }
}
</script>
