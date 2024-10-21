<script setup lang="ts">
import { ref } from 'vue';
import Button from 'primevue/button';
import type { Option, Step, StepId } from '@/types/Scenario';
import ActionStep from './ActionStep.vue';
import type { Nullable } from '@/types/utilities';
import OptionStepList from './OptionStepList.vue';
import { useDailyScenarioStore } from '@/store/dailyScenario';

type Props = {
  steps: Step[];
};

const props = defineProps<Props>();
const currentStep = ref<Step>(props.steps[0]);

const scenarioStore = useDailyScenarioStore();

const hasPreviousStep = (targetId: Nullable<StepId>): boolean => {
  return !!props.steps.find(step => step.scenario_step_id === targetId)
};

const previousStep = (): Step | undefined => {
  const previous = props.steps.find(step => step.scenario_step_id === currentStep.value.id);
  console.log('ScenarioSteps.vue:18', previous);

  if (previous) {
    currentStep.value = previous;
  }

  return previous;
};

const nextStep = (targetId: Nullable<StepId>): void => {
  currentStep.value = props.steps.find(step => step.id === targetId) ?? currentStep.value;
};

const options = (options: Option[]): Step[] => {
  return props.steps
    .filter(step => options.find(option => option.reference === step.id))
};

const buttonJustification = (step: Step) => {
  if (hasPreviousStep(step.id)) {
    return 'justify-between';
  }

  return 'justify-end';
};

const saveProgress = () => {
  console.log('ScenarioSteps.vue:52', 'saving progress');
}
</script>

<template>
  <div class="content-center">
    <div
      class="scene-steps mt-4"
    >
      <div>
        <h4 class="font-bold">
          Follow these steps:
        </h4>

        <ActionStep
          v-if="currentStep.type === 'step'"
          :step="currentStep"
        />

        <OptionStepList
          v-if="currentStep.type === 'option'"
          :step="currentStep"
          :option-steps="options(currentStep.options)"
        />

        <div
          class="flex flex-row"
          :class="buttonJustification(currentStep)"
        >

          <Button
            v-if="hasPreviousStep(currentStep.id)"
            @click="previousStep"
          >
            Previous Step
          </Button>

          <Button
            v-if="currentStep.scenario_step_id"
            :disabled="!scenarioStore.hasRolledFor(currentStep.id)"
            @click="nextStep(currentStep.scenario_step_id)"
          >
            Next Step
          </Button>

          <Button
            v-else
            :disabled="!scenarioStore.hasRolledFor(currentStep.id)"
            @click="saveProgress"
          >
            Save Progress
          </Button>
        </div>

      </div>
    </div>
  </div>
</template>
