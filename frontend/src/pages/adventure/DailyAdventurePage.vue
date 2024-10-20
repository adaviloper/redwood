<script setup lang="ts">
import { onMounted, ref } from 'vue';
import DailyScene from '@/components/scene/DailyScene.vue';
import { useScenarioRequests, type ShowScenarioResponse } from '@/composables/useScenarioRequests';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import type { Scenario } from '@/types/Scenario';
import type { Nullable } from '@/types/utilities';
import type { AxiosResponse } from 'axios';
import { useRouter } from 'vue-router';

const store = usePlayerCharacterStore();
const router = useRouter();
const scenarioRequests = useScenarioRequests();

const scenario = ref<Nullable<Scenario>>();

if (store.selectedPlayerCharacter === null) {
  router.push({ name: 'player-character-list' })
}

onMounted(() => {
  scenarioRequests.daily()
    .then(({ data }: AxiosResponse<ShowScenarioResponse>) => {
      scenario.value = data.scenario
    });
});
</script>

<template>
  <div class="px-6">
    <div
      v-if="scenario"
      class="flex flex-row"
    >
      <div v-if="store.selectedPlayerCharacter" class="w-full max-w-96 bg-red-50">
        <PlayerCharacterSideBar :player-character="store.selectedPlayerCharacter" />
      </div>
      <div class="grow-[4] bg-sky-50 content-center">
        <h1>{{ scenario.date }}</h1>
        <DailyScene :scenario="scenario" />
      </div>
    </div>
    <div
      v-else
    >
      Loading...
    </div>
  </div>
</template>

<style scoped>

</style>
