<script setup lang="ts">
type Input = {
	label: string;
	modelValue?: string;
	placeholder?: string;
	type?: string;
};

const { label } = defineProps<Input>();

const emit = defineEmits(["update:modelValue"]);

const id = label.toLocaleLowerCase().replace(" ", "-");
</script>

<template>
	<div>
		<label :for="id" class="block text-sm font-medium mb-2">
			{{ label }}
		</label>

		<div class="relative">
			<input
				:id
				:type="type || 'text'"
				:placeholder="placeholder || ''"
				:value="modelValue"
				class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none placeholder-gray-300 text-white" />

			<slot />
		</div>
	</div>
</template>
