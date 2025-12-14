<template>
  <div class="flex items-center justify-between">
    <p v-if="showInfo && total > 0" class="text-sm text-gray-700">
      Showing <span class="font-medium">{{ (modelValue - 1) * perPage + 1 }}</span>
      to <span class="font-medium">{{ Math.min(modelValue * perPage, total) }}</span>
      of <span class="font-medium">{{ total }}</span> results
    </p>
    <div v-else></div>

    <nav class="flex items-center gap-1">
      <button @click="goToPage(modelValue - 1)" :disabled="modelValue <= 1" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
      </button>

      <template v-for="page in pages" :key="page">
        <span v-if="page === '...'" class="px-3 py-2 text-sm text-gray-500">...</span>
        <button v-else @click="goToPage(page)" :class="['px-3 py-2 text-sm font-medium rounded-lg', page === modelValue ? 'bg-blue-600 text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50']">
          {{ page }}
        </button>
      </template>

      <button @click="goToPage(modelValue + 1)" :disabled="modelValue >= totalPages" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
      </button>
    </nav>
  </div>
</template>

<script>
import { computed } from 'vue';

export default {
  name: 'LdPagination',
  props: {
    modelValue: { type: Number, default: 1 },
    totalPages: { type: Number, required: true },
    perPage: { type: Number, default: 10 },
    total: { type: Number, default: 0 },
    onEachSide: { type: Number, default: 2 },
    showInfo: { type: Boolean, default: true }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const pages = computed(() => {
      const result = [];
      const start = Math.max(1, props.modelValue - props.onEachSide);
      const end = Math.min(props.totalPages, props.modelValue + props.onEachSide);
      if (start > 1) { result.push(1); if (start > 2) result.push('...'); }
      for (let i = start; i <= end; i++) result.push(i);
      if (end < props.totalPages) { if (end < props.totalPages - 1) result.push('...'); result.push(props.totalPages); }
      return result;
    });

    const goToPage = (page) => {
      if (page >= 1 && page <= props.totalPages) emit('update:modelValue', page);
    };

    return { pages, goToPage };
  }
};
</script>
