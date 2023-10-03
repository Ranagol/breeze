<template>
    <h1 class="text-4xl font-bold">Page: HOME</h1>
</template>

<script>
import Layout from '../Shared/Layout.vue';
export default {
name: 'Home',
    components: {
        /**
         * permanent layout. This Layout will be the parent component for Home. Even though it is not
         * in this code the <Layout></Layout>, because we didn't type it, it will be there.
         */
        layout: Layout//
    }
}
</script>
