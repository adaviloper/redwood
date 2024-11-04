<script setup lang="ts">
import { format, parseISO } from 'date-fns';
import ScenarioSteps from '@/components/scene/steps/ScenarioSteps.vue'
import { useDailyScenarioStore } from '@/store/dailyScenario';

type Props = {
  date: string;
}

defineProps<Props>()

const dailyScenarioStore = useDailyScenarioStore();

const scenario = dailyScenarioStore.scenario;
</script>

<template>
  <div class="content-center p-6">
    <div v-if="scenario">
      <h1>{{ format(parseISO(scenario.date), 'EEEE, MMMM do, yyyy') }}</h1>

      <div class="scene-narrative">
        {{ scenario.narrative }}
      </div>

      <div class="scene-steps">
        <ScenarioSteps :steps="scenario.steps" />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
