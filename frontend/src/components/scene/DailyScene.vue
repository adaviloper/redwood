<script setup lang="ts">
import { ref } from 'vue';
import Button from 'primevue/button';
import type { Scenario } from '@/types/Scenario';
import ScenarioSteps from '@/components/scene/ScenarioSteps.vue';

const hasStarted = ref<boolean>(false);

type Props = {
  scenario: Scenario;
};

defineProps<Props>();

const beginTodaysAdventure = () => {
  hasStarted.value = true;
};

</script>

<template>
  <div class="content-center p-6">

    <div v-if="!hasStarted" class="grid place-items-center">
      <Button class="begin-scene-button" @click="beginTodaysAdventure">Begin</Button>
    </div>

    <div v-if="scenario && hasStarted">
      <h1>{{ scenario.date }}</h1>

      <div class="scene-narrative">
        {{ scenario.narrative }}
      </div>

      <div
        class="scene-steps"
      >
        <ScenarioSteps
          :steps="scenario.steps"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
