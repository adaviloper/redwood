<script setup lang="ts">
import { useDailyScenarioStore } from '@/store/dailyScenario';
import type { TOptionStep, Step, StepId, Roll } from '@/types/Scenario';

type Props = {
  step: TOptionStep;
  optionSteps: Step[];
};

defineProps<Props>();
const scenarioStore = useDailyScenarioStore();

const optionSelected = (stepId: StepId, roll: Roll) => {
  console.log('OptionStepList.vue:14');
  scenarioStore.setStepResult(stepId, roll);
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
        :select-handler="optionSelected"
      />

    </div>
  </div>
</template>

<style scoped>

</style>
