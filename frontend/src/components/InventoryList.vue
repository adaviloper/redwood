<script setup lang="ts">
import type { Item } from '@/types/Item';

interface Props {
  items: Item[];
}

defineProps<Props>();

</script>

<template>
  <div>
    <h3>Inventory</h3>

    <ul>
      <li v-for="item in items" :key="`item-${item.name}`">{{ item.name }} ({{ item.quantity }})</li>
    </ul>
  </div>
</template>

<style scoped>

</style>
