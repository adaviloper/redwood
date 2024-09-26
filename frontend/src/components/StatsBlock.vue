<script setup lang="ts">
import type { Stat } from '@/types/Character';

interface Props {
  stats: Stat[];
}

defineProps<Props>();

</script>

<template>
  <div>
    <h3>Stats</h3>
    <ul>
      <li v-for="stat in stats" :key="`stat-${stat.name}`">{{ stat.name }}: {{ stat.value }}</li>
    </ul>
  </div>
</template>

<style scoped>

</style>
