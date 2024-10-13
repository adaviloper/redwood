<script setup lang="ts">
import DailyScene from '@/components/scene/DailyScene.vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import type { Scenario } from '@/types/Scenario';
import { useRouter } from 'vue-router';

const store = usePlayerCharacterStore();
const router = useRouter();

const scene: Scenario = {
  narrative: 'Some story',
  startingStep: 'bb',
  steps: {
    aa: { // Step 1
      label: 'Step 1',
      copy: 'Step 1 options',
      options: [
        {
          copy: 'Option A',
        },
        {
          copy: 'Option B',
          next: 'bb',
        },
      ],
      next: 'dd',
    },
    bb: {
      label: 'Option B steps',
      copy: 'Some copy',
      options: [
        {
          copy: 'Option 1.B.1',
          next: 'cc',
        },
        {
          copy: 'Option 1.B.2',
        },
      ],
    },
    cc: {
      label: 'Steps 1.B.1',
      copy: 'Copylkjsdf',
      options: [
        {
          copy: 'Option 1.B.1.1',
        },
        {
          copy: 'Option 1.B.1.2',
        }
      ],
    },
    dd: {
      label: 'Step 2',
      copy: 'Copylkjsdf',
    },
  },
};

if (store.selectedPlayerCharacter === null) {
  router.push({ name: 'player-character-list' })
}
</script>

<template>
  <div class="px-6">
    <div class="flex flex-row">
      <div v-if="store.selectedPlayerCharacter" class="w-full max-w-96 bg-red-50">
        <PlayerCharacterSideBar :player-character="store.selectedPlayerCharacter" />
      </div>
      <div class="grow-[4] bg-sky-50 content-center">
        <DailyScene :scenario="scene" />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
