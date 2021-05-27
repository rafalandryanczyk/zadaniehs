import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import VueLodash from 'vue-lodash';
import lodash from 'lodash';

Vue.use(plugin)
Vue.use(VueLodash, { lodash });

const el = document.getElementById('app')

new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)
