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
			'w-full py-3 rounded-lg font-semibold shadow-lg transition-all flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white cursor-pointer',
		]">
		{{ label }}
		<slot />
	</button>
</template>
