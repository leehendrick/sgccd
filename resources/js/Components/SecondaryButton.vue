<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md font-semibold text-xs  uppercase tracking-widest shadow-sm hover:border focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
