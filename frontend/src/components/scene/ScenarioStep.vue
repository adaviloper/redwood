<script setup lang="ts">
import type { Step } from '@/types/Scenario';
import Button from 'primevue/button'

type Props = {
  step: Step;
};

defineProps<Props>();
</script>

<template>
  <div>
    {{ step.label }}
    <Button type="submit">Select</Button>
  </div>
</template>

<style scoped>

</style>
