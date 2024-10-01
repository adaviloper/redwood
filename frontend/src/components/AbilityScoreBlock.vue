<script setup lang="ts">
import type { Ability } from '@/types/Ability';


interface Props {
  abilities: Ability[];
}

defineProps<Props>();

</script>

<template>
  <div>
    <h3>Stats</h3>

    <div class="box-borders flex flex-row">
      <div
        v-for="ability in abilities"
        :key="`stat-${ability.name}`"
        class="grow"
      >
        <p class="text-center text-2xl">{{ ability.value }}</p>
        <p class="text-center">{{  ability.name.substring(0, 3)  }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
