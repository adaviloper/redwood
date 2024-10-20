<script setup lang="ts">
import type { TActionStep } from '@/types/Scenario';

type Props = {
  step: TActionStep;
};

defineProps<Props>();
</script>

<template>
  <div>
    {{ step.action.type.charAt(0).toUpperCase() + step.action.type.slice(1) }} a {{ step.action.dice }} + [{{ step.action.ability.slice(0, 3).toUpperCase() }}]
  </div>
</template>

<style scoped>

</style>
