<script setup lang="ts">
import Button from 'primevue/button';
import type { Step } from '@/types/Scenario';
import { type Option } from '@/types/Scenario';
import ActionStep from './ActionStep.vue';

type Props = {
  step: Step;
  steps: Step[];
};

const props = defineProps<Props>();

const options = (options: Option[]): Step[] => {
  return props.steps
    .filter(step => options.find(option => option.reference === step.id))
};
</script>

<template>
  <div class="content-center">
    <div
      class="scene-steps"
    >
      <div>
        <h2>
          {{ step.copy }}
        </h2>

        <ActionStep
          v-if="step.type === 'step'"
          :step="step"
        />

        <div
          v-if="step.type === 'option'"
        >
          <div
            v-for="option in options(step.options)"
            :key="`option-${option.id}`"
          >

            <ActionStep
              v-if="option.type === 'step'"
              :step="option"
            />

          </div>
        </div>

      </div>
    </div>
  </div>
</template>
