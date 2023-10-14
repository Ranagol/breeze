<template>
		<!-- We are sending this h1 to a slot in Layout -->
		<h1 class="text-4xl font-bold">Page: HOME</h1>

		<!-- HEAD component -->
		<Head>
			<!-- With this here we can dynamically change the app title, which is displayed in the
			Chrome tab. Also, the Head component is globally registered, so that is why we are not
			importing it into this component. -->
			<title>Home tab title</title>
		</Head>


</template>

<script lang="ts">

export default {
	name: 'Home',
	components: {
	},
	data() {
		return {
		}
	}
}
</script>
