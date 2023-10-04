<template>
  <Head title="Users new" />

  <Layout>
    <!-- <div>
      <h1 class="text-4xl font-bold">Page: Users</h1>

      <h4>Users list</h4>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }}</li>
      </ul>
    </div> -->


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="user in users.data" :key="user.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div>
                          <div class="text-sm font-medium text-gray-900">
                            {{ user.name }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <!-- <td v-if="user.can.edit" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"> -->
                      <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900"> Edit</Link>
                    <!-- </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <Pagination :links="users.links" class="mt-6" />
  </Layout>
</template>


<script lang="ts">
import Layout from '../../Shared/Layout.vue';
import Pagination from "../../Shared/Pagination.vue";
export default {
  name: 'Users',
  components: {
    Layout,
    Pagination
  },
  props: {
    users: Array,
  },
}
</script>
