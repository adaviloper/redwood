<script setup lang="ts">
import { computed } from 'vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import { RouterView, useRouter } from 'vue-router';
import { useDailyScenarioStore } from '@/store/dailyScenario';

const store = usePlayerCharacterStore();
const router = useRouter();
const dailyScenarioStore = useDailyScenarioStore();

const scenario = computed(() => {
  return dailyScenarioStore.scenarios;
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

      <div class="grow-[4] bg-sky-50">
        <router-view />
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
