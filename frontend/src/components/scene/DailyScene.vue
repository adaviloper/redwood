<script setup lang="ts">
import { ref } from 'vue'
import { format } from 'date-fns';
import Button from 'primevue/button'
import ScenarioSteps from '@/components/scene/steps/ScenarioSteps.vue'
import { useDailyScenarioStore } from '@/store/dailyScenario';

const hasStarted = ref<boolean>(false)

type Props = {
}

const dailyScenarioStore = useDailyScenarioStore();

dailyScenarioStore.setScenario();
const scenario = dailyScenarioStore.scenario;
defineProps<Props>()

const beginTodaysAdventure = () => {
  hasStarted.value = true
}
</script>

<template>
  <div class="content-center p-6">
    <div v-if="!hasStarted" class="grid place-items-center content-center">
      <Button class="begin-scene-button" @click="beginTodaysAdventure">Begin</Button>
    </div>

    <div v-if="scenario && hasStarted">
      <h1>{{ format(scenario.date, 'EEEE, MMMM do, yyyy') }}</h1>

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
