<template>
  <Head title="Users new" />

  <div class="flex justify-between mb-6">

    <!-- LINK FOR CREATING A NEW USER -->
    <div class="flex items-center">
        <h1 class="text-3xl">Users</h1>

        <!-- v-if="can.createUser" -->
        <Link  href="/users/create" class="text-blue-500 text-sm ml-3">New User</Link>
    </div>

    <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg" />
  </div>

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
</template>


<script lang="ts">
import Layout from '../../Shared/Layout.vue';
import Pagination from "../../Shared/Pagination.vue";
// import { Inertia } from '@inertiajs/inertia';
import debounce from "lodash/debounce";
import throttle from "lodash/throttle";
import { defineComponent, ref, watch } from 'vue';
import { Inertia } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/inertia';


export default defineComponent({
  name: 'Users',
  components: {
    Layout,
    Pagination
  },
  props: {
    users: Object,
    filters: {//this filters have a search property
        type: Object,
        default: () =>  {}
    },
    can: Object
  },
  data() {
    return {
      search: this.filters.search,
    }
  },
  watch: {//1. style
    search: debounce(function (value) {
      this.$inertia.get('/users', {search: value}, {
        preserveState: true,
        replace: true
      })
    }, 300)
  }

  // watch: {//2. style
    
  //   /**
  //    * whenever the value in search input field changes, this function will send a new request.
  //    * Meaning: for every typed in letter, Vue will send a request. That is not good. We want requests,
  //    * but not that many.
  //    */
  //   search(newValue, oldValue) {
  //     console.log('newValue:', newValue);
  //     console.dir('inertia object', this.$inertia);
  //     /**
  //      * this.$inertia.get(... <- this is for Options API only, will not work in Composition API.
  //      *
  //      * Here we are making a get request. Meaning, this request and its params will appear in the
  //      * query string. This will create something like this:
  //      * http://127.0.0.1:8000/users?search=mySearchTerm
  //      *
  //      * Whenever we trigger the this.$inertia, it will rerender the page. And the typed in letter
  //      * in the search field will disappear. We have to preserve this state, so the typed in letters
  //      * do not disappear. We do this with this line: { preserveState: true }.
  //      *
  //      * Now, we send a request for every typed letter. This is not good.
  //      */
  //     this.$inertia.get(
  //       '/users',
  //       { search: this.search},//here we send our search term to the backend
  //       {
  //         preserveState: true,//to remember search term
  //         replace: true//something about history records... Not important
  //       }
  //     );
  //   }
  // },

});
</script>
