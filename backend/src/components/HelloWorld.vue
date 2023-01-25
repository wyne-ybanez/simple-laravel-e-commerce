<script setup>
  import { ref, computed } from 'vue';
  import store from "../store";

  const test = computed(()=> store.state.test)

  const count = ref(0)
</script>

<template>
  <p>{{ test }}</p>
</template>