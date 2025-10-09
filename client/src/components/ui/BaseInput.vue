<script setup lang="ts">
const modelValue = defineModel<string>();

const { label } = defineProps<{
	label?: string;
	type?: string;
	placeholder?: string;
}>();

const id = label ? label.toLowerCase().replace(" ", "-") : "input";
</script>

<template>
	<div>
		<label v-if="label" :for="id" class="block text-sm font-medium mb-2">
			{{ label }}
		</label>

		<div class="relative">
			<input
				v-model="modelValue"
				:id="id"
				:type="type || 'text'"
				:placeholder="placeholder || ''"
				class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none placeholder-gray-300 text-white" />
			<slot />
		</div>
	</div>
</template>
