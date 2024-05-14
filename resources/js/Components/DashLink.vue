<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "bg-primary text-white"
        : "text-gray-400 hover:text-white hover:bg-primary",
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
