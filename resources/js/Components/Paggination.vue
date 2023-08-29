<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
     <div class="mt-4 flex justify-center">
        <Link
            :href="prev"
            class="px-4 py-2 mr-2 bg-blue-500 text-white rounded"
            :class="{ 'opacity-50 cursor-not-allowed': !prev }"
        >
            Anterior
        </Link>

        <div class="flex items-center space-x-2">
            <template v-for="page in filteredLinks" :key="page.label">
                <Link
                    :href="page.url"
                    class="px-3 py-2 rounded"
                    :class="{ 'bg-blue-500 text-white': page.active, 'text-gray-500': !page.active }"
                >
                    {{ page.label }}
                </Link>
            </template>
        </div>

        <Link
            :href="next"
            class="px-4 py-2 ml-2 bg-blue-500 text-white rounded"
            :class="{ 'opacity-50 cursor-not-allowed': !next }"
        >
            Próximo
        </Link>
    </div>
</template>

<script>
export default {
  props: {
    links: Object,
    next: String,
    prev: String,
  },
  computed: {
    filteredLinks() {
      return this.links.filter((page) => page.label !== "&laquo; Previous" && page.label !== "Next &raquo;").slice(0, 4);
    },
  },
}
</script>