<template>
  <div class="p-4 mx-auto prose md:px-6 prose-indigo sm:rounded-md">
    <h2>{{ character.name }} ({{ character.hp }}/{{character.maxHp }})</h2>

    <StatsBlock :stats="character.stats" />

    <Inventory :items="character.inventory" />
  </div>
</template>

<script setup lang="ts">
import Inventory from '@/components/Inventory.vue';
import StatsBlock from '@/components/StatsBlock.vue';
import { character } from '@/data/lightfoot';
</script>
