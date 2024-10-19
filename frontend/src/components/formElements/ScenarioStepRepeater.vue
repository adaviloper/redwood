<script setup lang="ts">
import { FormKit } from '@formkit/vue';
import { type FormKitGroupValue } from '@formkit/core';
import ScenarioOptionRepeater from './ScenarioOptionRepeater.vue';
import ActionStepGroup from './ActionStepGroup.vue';

type Step = {
  id: string;
  type: string;
  next: string;
  copy: string;
};

type Props = {
  rootRepeaterValues: FormKitGroupValue;
  currentStep?: Record<string, any>;
};

defineProps<Props>();

const getFormattedSteps = (steps: Step[], id: unknown) => {
  return steps.filter(step => step.id !== id && step.next !== id).map(step => {
    return {
      value: step.id,
      label: step.copy || step.id,
    };
  });
};
</script>

<template>
  <div>
    <FormKit
      v-if="currentStep?.type === 'step'"
      type="group"
      name="action"
      label="Action to take"
    >
      <ActionStepGroup :action="currentStep.action" />
    </FormKit>

    <FormKit
      v-if="rootRepeaterValues?.steps && Array.isArray(rootRepeaterValues.steps) && rootRepeaterValues.steps.length > 1"
      type="dropdown"
      name="next"
      label="Next Step"
      :value="currentStep.scenario_step_id"
      :options="getFormattedSteps(rootRepeaterValues.steps, currentStep?.id)"
    >
      <option
        v-for="option in rootRepeaterValues.steps"
        :key="option.id"
        :value="option.id"
      >
        {{ option.copy || option.id }}
      </option>
    </FormKit>

    <ScenarioOptionRepeater
      v-if="currentStep?.type === 'option'"
      :root-repeater-values="rootRepeaterValues"
      :current-step="currentStep"
    />

    <!-- <pre> -->
    <!--   {{ currentStep }} -->
    <!-- </pre> -->

  </div>
</template>
