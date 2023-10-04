<template>
  <Head title="Users new" />

  <Layout>
    <div>
      <h1 class="text-4xl font-bold">Page: Users</h1>

      <h4>Users list</h4>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }}</li>
      </ul>
    </div>
  </Layout>
</template>


<script lang="ts">
import Layout from '../../Shared/Layout.vue';
export default {
  name: 'Users',
  components: {
    Layout,
  },
  props: {
    users: Array,
  },
}
</script>
