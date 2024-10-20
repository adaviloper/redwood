<script setup lang="ts">
import { ref } from 'vue';
import type { OptionStep, Step } from '@/types/Scenario';
import Button from 'primevue/button';
import type { Nullable } from '@/types/utilities';

type Props = {
  step: OptionStep;
  optionSteps: Step[];
};


defineProps<Props>();

const rollResult= ref<Nullable<number>>(null);

const select = (step: Step) => {
  rollResult.value = Math.ceil(Math.random() * 20);
};
</script>

<template>
  <div>
    <div
      v-for="(optionStep, index) in optionSteps"
      :key="`option-${optionStep.id}`"
    >
      <h4>
        Option {{ index + 1 }}
      </h4>

      <OptionStep
        :step="optionStep"
      />

    </div>
  </div>
</template>

<style scoped>

</style>
