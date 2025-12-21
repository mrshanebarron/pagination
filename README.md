# Pagination

A pagination component for Laravel applications. Displays page numbers with navigation controls. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/pagination
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-pagination
    wire:model="page"
    :total-pages="10"
/>
```

### With Item Count

```blade
<livewire:sb-pagination
    wire:model="page"
    :total-pages="15"
    :per-page="20"
    :total="300"
    :show-info="true"
/>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | number | `1` | Current page number |
| `total-pages` | number | required | Total number of pages |
| `per-page` | number | `10` | Items per page |
| `total` | number | `0` | Total item count |
| `on-each-side` | number | `2` | Pages shown on each side |
| `show-info` | boolean | `true` | Show "Showing X to Y of Z" |

## Vue 3 Usage

### Setup

```javascript
import { SbPagination } from './vendor/sb-pagination';
app.component('SbPagination', SbPagination);
```

### Basic Usage

```vue
<template>
  <SbPagination
    v-model="currentPage"
    :total-pages="totalPages"
  />
</template>

<script setup>
import { ref } from 'vue';
const currentPage = ref(1);
const totalPages = 10;
</script>
```

### With Results Info

```vue
<template>
  <SbPagination
    v-model="currentPage"
    :total-pages="totalPages"
    :per-page="perPage"
    :total="totalItems"
    show-info
  />
</template>

<script setup>
import { ref, computed } from 'vue';

const currentPage = ref(1);
const perPage = 20;
const totalItems = 157;
const totalPages = computed(() => Math.ceil(totalItems / perPage));
</script>
```

### Data Table Example

```vue
<template>
  <div>
    <!-- Table -->
    <table class="w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in paginatedUsers" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
      <SbPagination
        v-model="currentPage"
        :total-pages="totalPages"
        :per-page="perPage"
        :total="users.length"
        @update:model-value="fetchPage"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const currentPage = ref(1);
const perPage = 10;
const users = ref([]); // Your data

const totalPages = computed(() => Math.ceil(users.value.length / perPage));

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return users.value.slice(start, start + perPage);
});

const fetchPage = (page) => {
  // Fetch data for new page
};
</script>
```

### Custom Visible Pages

```vue
<template>
  <!-- Show more page numbers -->
  <SbPagination
    v-model="page"
    :total-pages="100"
    :on-each-side="3"
  />

  <!-- Show fewer page numbers -->
  <SbPagination
    v-model="page"
    :total-pages="100"
    :on-each-side="1"
  />
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | Number | `1` | Current page (v-model) |
| `totalPages` | Number | required | Total page count |
| `perPage` | Number | `10` | Items per page (for info) |
| `total` | Number | `0` | Total items (for info) |
| `onEachSide` | Number | `2` | Visible pages each side |
| `showInfo` | Boolean | `true` | Show results info text |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | `number` | Emitted when page changes |

## Features

- **Page Numbers**: Shows current page with neighbors
- **Ellipsis**: Shows `...` for skipped ranges
- **First/Last**: Always shows first and last page
- **Navigation**: Previous/next buttons
- **Results Info**: "Showing X to Y of Z results"

## Page Display Logic

With `onEachSide: 2` and 20 total pages:
- Page 1: `1 2 3 ... 20`
- Page 5: `1 ... 3 4 5 6 7 ... 20`
- Page 20: `1 ... 18 19 20`

## Styling

Uses Tailwind CSS:
- White buttons with border
- Blue background for current page
- Disabled state for first/last page
- Hover effects

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
