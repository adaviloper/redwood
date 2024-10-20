<script setup lang="ts">
import type { Step } from '@/types/Scenario';

type Props = {
  step: Step;
};

defineProps<Props>();

</script>

<template>
  <div>
    <div >
      <p>
        {{ step.copy }}
      </p>

      <ActionStep
        v-if="step.type === 'step'"
        :step="step"
      />

    </div>
  </div>
</template>

<style scoped>

</style>
