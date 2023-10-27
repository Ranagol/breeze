<template>
  <!-- We are sending this h1 to a slot in Layout -->
  <h1 class="text-4xl font-bold">Page: SETTINGS</h1>

  <p>The client</p>
  <div>Here it is: {{ client }}</div>
  

</template>

<script>
import Layout from '../Shared/Layout.vue';
import { defineComponent, ref, watch } from 'vue';

export default defineComponent({
  name: 'Settings',
  components: {
    Layout
  },
  props: {
    andorData: Object,
    client: Object
  }
});
</script>

