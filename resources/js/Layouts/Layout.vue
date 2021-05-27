<template>
  <div class="layout">
    <div v-if="$page.props.auth.user !== null">
      Hello, {{ $page.props.auth.user.email }},
      <inertia-link href="/logout" method="delete">Logout</inertia-link>
    </div>
    <transition name="page">
      <div v-if="animate">
        <slot />
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  data() {
    return {
      animate: false,
    };
  },
  mounted() {
    this.animate = true;
  },
};
</script>

<style>
.page-enter-active,
.page-leave-active {
  transition: all 0.3s;
}

.page-enter,
.page-leave-active {
  opacity: 0;
}
</style>
