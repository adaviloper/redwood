<script setup lang="ts">
import type { Step } from '@/types/Scenario';

type Props = {
  steps: Step[];
  indent?: number;
};

withDefaults(defineProps<Props>(), {
  indent: 0,
});
</script>

<template>
  <div class="content-center">
    <div
      class="scene-steps"
      :class="`ml-${indent} pl-${indent}`"
    >
      <div
        v-for="(step, stepIndex) in steps"
        :key="`step-${stepIndex}`"
      >
        <div v-if="step.options.length === 1">
          {{ stepIndex + 1 }}: {{ step.options[0].copy }}
        </div>

        <div v-else>
          <div
            v-for="(option, optionIndex) in step.options"
            :key="`option-${optionIndex}`"
          >
            <div v-if="option.copy">
              {{ stepIndex === 1 ? `${stepIndex + 1}.` : '' }}{{ optionIndex + 1 }}: {{ option.copy }}
            </div>

            <ScenarioSteps
              v-if="option.steps"
              :steps="option.steps"
              :indent="stepIndex + 2"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
