<script setup lang="ts">
defineProps<{
	label: string;
	type?: "button" | "submit";
}>();
</script>

<template>
	<button
		:type="type || 'button'"
		:class="[
			'w-full py-3 rounded-lg font-semibold shadow-lg transition-all flex items-center justify-center gap-2 bg-fuchsia-600 hover:bg-fuchsia-700 text-white cursor-pointer',
		]">
		{{ label }}
		<slot />
	</button>
</template>
