<template>
  <Head title="Create new user" />

  <h1 class="text-3xl">Create New User</h1>

  <h1 v-text="text"></h1>

  <!-- NAME -->
  <!-- Here we prevent the default submitting behaviour of the <form></form>. Instead we say to the
  form: when you are submitted, do not send the data to backend, just trigger the submit() method.
  submit() will do the rest of the job. -->
  <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Name </label>

      <input
        v-model="form.name"
        class="border border-gray-400 p-2 w-full"
        type="text"
        name="name"
        id="name"
      />

      <div
        v-if="form.errors.name"
        v-text="form.errors.name"
        class="text-red-500 text-xs mt-1"></div
      >
    </div>

    <!-- EMAIL -->
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

      <input
        v-model="form.email"
        class="border border-gray-400 p-2 w-full"
        type="email"
        name="email"
        id="email"
      />

      <div
        v-if="form.errors.email"
        v-text="form.errors.email"
        class="text-red-500 text-xs mt-1"></div
      >
    </div>

    <!-- PASSWORD -->
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password"> Password </label>

      <input
        v-model="form.password"
        class="border border-gray-400 p-2 w-full"
        type="password"
        name="password"
        id="password"
      />

      <!-- ERROR DISPLAY -->
      <div
        v-if="form.errors.password"
        v-text="form.errors.password"
        class="text-red-500 text-xs mt-1"></div
      >
    </div>

    <!-- SUBMIT BUTTON -->
    <div class="mb-6">
      <button
        type="submit"
        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
        :disabled="form.processing"
        >Submit
      </button>
    </div>
  </form>

</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { useForm } from '@inertiajs/vue3';//0-Importing the form helper
export default defineComponent({
	name:'Create',
		components: {
	},
	data() {
		return {
			form: useForm({//1-we create the form object ind data()
				name: '',
				email: '',
				password: '',
			}),
      text: 'Some random text from data()',
		}
	},

	methods: {
		submit(){
			this.form.post('/users');//2-We use the form object from the data() for sending requests
		}
	},

  mounted() {
    console.log(`the component is now mounted.`);
    console.dir(this.$page);
    console.dir(this.$page.props.errors);
  }


});
</script>

<style scoped>

</style>



