<template>
  <div>
    <!-- This is a DYNAMIC LOOPED component used for displaying pagination links.
        It will either be an Inertia <Link> or a <span></span>. Becase the links for the pages
        must be <Link> but the 'Previous' and 'Next' button must be <span></span>.
        Link for the first page with 1-10 user, link for the second page with the 11-20 user, ... etc.
        v-html will add/create a new html element, whatever is in the link.label.
    -->
    <Component
      :is="link.url ? 'Link' : 'span'"
      v-for="link in links"
      :href="link.url"
      v-html="link.label"
      class="px-1"
      :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
    />
  </div>
</template>

<script>
export default {
  props: {
    links: Array
  }
};
</script>
