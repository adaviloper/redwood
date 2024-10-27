<script setup lang="ts">
import { computed } from 'vue';
import DailyScene from '@/components/scene/DailyScene.vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import { useRouter } from 'vue-router';
import { useDailyScenarioStore } from '@/store/dailyScenario';

const store = usePlayerCharacterStore();
const router = useRouter();
const dailyScenarioStore = useDailyScenarioStore();

dailyScenarioStore.setScenario();

const scenario = computed(() => {
  return dailyScenarioStore.scenario;
});

if (store.selectedPlayerCharacter === null) {
  router.push({ name: 'player-character-list' })
}

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
