<script setup lang="ts">
import type { Roll, Step, StepId } from '@/types/Scenario';

type Props = {
  step: Step;
  selectHandler: (stepId: StepId, roll: Roll) => void;
};

defineProps<Props>();
</script>

<template>
  <div>
    <ActionStep
      v-if="step.type === 'step'"
      :step="step"
      @option-selected="selectHandler"
    />
  </div>
</template>

<style scoped>

</style>
