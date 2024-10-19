<script setup lang="ts">
import { FormKit } from '@formkit/vue';
import { type FormKitGroupValue } from '@formkit/core';

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
      v-slot="{ value }"
      type="repeater"
      name="options"
      label="Options"
      :insert-control="true"
    >
      <FormKit
        v-if="rootRepeaterValues?.steps && Array.isArray(rootRepeaterValues.steps) && rootRepeaterValues.steps.length > 1"
        type="dropdown"
        name="scenario_step_id"
        label="Referenced Step"
        :value="value.reference"
        :options="getFormattedSteps(rootRepeaterValues.steps, currentStep.id)"
      >
        <option
          v-for="option in rootRepeaterValues.steps"
          :key="option.id"
          :value="option.id"
        >
          {{ option.copy || option.id }}
        </option>
      </FormKit>
    </FormKit>
  </div>
</template>
