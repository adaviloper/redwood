<script setup lang="ts">
import type { Ability } from '@/types/Character';

interface Props {
  abilities: Ability[];
}

defineProps<Props>();

</script>

<template>
  <div>
    <h3>Stats</h3>

    <div class="columns-6">
      <div v-for="ability in abilities" :key="`stat-${ability.name}`">
        <h4 class="text-center">{{ ability.value }}</h4>
        <h5 class="text-center">{{  ability.name.substring(0, 3)  }}</h5>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
