<script setup lang="ts">
import { ref } from 'vue';
import type { Step, StepId } from '@/types/Scenario';
import Button from 'primevue/button';

type Props = {
  step: Step;
  stepId: StepId;
};

const selected = ref<boolean>(false);
const select = () => {
  selected.value = true;
};

defineProps<Props>();
</script>

<template>
  <div>
    {{ step.label }}
    <Button :class="`select-options-${stepId}`" @click="select">Select</Button>
    <div
      v-if="selected || !step.next"
      class="ml-4"
    >
      <div
        v-for="(option, index) in step.options"
        :key="`option-${index}`"
      >
        {{ option.copy }}
        <Button type="submit">Select</Button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>

