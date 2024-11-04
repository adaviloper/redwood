<script setup lang="ts">
import { useDailyScenarioStore } from '@/store/dailyScenario';
import type { Step, StepId } from '@/types/Scenario';
import Card from 'primevue/card';

type Props = {
};

defineProps<Props>();
const dailyScenarioStore = useDailyScenarioStore();

const rolls = dailyScenarioStore.rolls;
const steps = dailyScenarioStore.scenario.steps;
const mappedSteps = steps.reduce((acc: Record<StepId, Step>, step) => {
  acc[`${step.id}`] = step;
  return acc;
}, {});


</script>

<template>
  <div>
    <div
      v-for="roll in rolls"
      :key="`roll-${roll.scenario_step_id}`"
    >
      <Card>
        <template #content>
          {{ mappedSteps[`${roll.scenario_step_id}`].copy }} <br />
          {{ roll.dieResult }} + {{ roll.modifierValue }}({{ roll.ability.slice(0, 3) }}) = {{ roll.total }}
        </template>
      </Card>
    </div>
  </div>
</template>

<style scoped>

</style>
