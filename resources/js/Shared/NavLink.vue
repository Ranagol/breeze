<template>
  <Link
    class="text-black hover:underline"
    :class="{'font-bold underline': active }"
  >
    <slot />
  </Link>
</template>

<script>
/**
 * This component is just a wrapper with a slot for the Link component.
 */
export default {
    props: {
        active: Boolean
    }
};
</script>

