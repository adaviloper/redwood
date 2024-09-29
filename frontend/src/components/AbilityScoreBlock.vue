<script setup lang="ts">
import { computed } from 'vue';
import type { Ability } from '@/types/Character';

interface Props {
  ability: Ability[];
}

const props = defineProps<Props>();

const physicalStats = computed(() => {
  return props.ability.filter(stat => stat.type === 'physical');
});
const mentalStats = computed(() => {
  return props.ability.filter(stat => stat.type === 'mental');
});

</script>

<template>
  <div>
    <h3>Stats</h3>
      <ul class="columns-6">
        <li v-for="stat in ability" :key="`stat-${stat.name}`">
          {{ stat.name.substring(0, 3) }}: {{ stat.value }}
        </li>
      </ul>

    <h3>Two Columns</h3>
    <div class="columns-2">
      <ul>
        <li v-for="stat in physicalStats" :key="`stat-${stat.name}`">
          {{ stat.name }}: {{ stat.value }}
        </li>
      </ul>

      <ul>
        <li v-for="stat in mentalStats" :key="`stat-${stat.name}`">
          {{ stat.name }}: {{ stat.value }}
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>

</style>
