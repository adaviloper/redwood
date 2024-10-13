<script setup lang="ts">
import type { Step, StepId, StepsList } from '@/types/Scenario';
import ScenarioStep from './ScenarioStep.vue';
import ScenarioOption from './ScenarioOption.vue';

type Props = {
  steps: StepsList;
  indent?: number;
  startingStep: StepId;
};

const props = withDefaults(defineProps<Props>(), {
  indent: 0,
});

const getSteps = (key: StepId): Step[] => {
  if (props.steps[`${key}`] === null) {
    return [];
  }
  const stepsList = [];
  stepsList.push(props.steps[`${key}`])
  const nextKey = props.steps[`${key}`].next
  if (nextKey && props.steps[`${nextKey}`]) {
    stepsList.push(props.steps[`${nextKey}`])
  }
  return stepsList;
};
</script>

<template>
  <div class="content-center">
    <div
      class="scene-steps"
      :class="`ml-${indent} pl-${indent}`"
    >
      <div
        v-for="(step, stepId) in getSteps(props.startingStep)"
        :key="`step-${stepId}`"
      >
        <ScenarioOption
          v-if="step.options"
          :step-id="startingStep"
          :step="step"
        />
        <ScenarioStep
          v-if="!step.options"
          :step="step"
        />
      </div>
    </div>
  </div>
</template>
