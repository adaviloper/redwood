<script setup lang="ts">
import DailyScene from '@/components/scene/DailyScene.vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import type { Scenario } from '@/types/Scenario';
import { useRouter } from 'vue-router';

const store = usePlayerCharacterStore();
const router = useRouter();

const scene: Scenario = {
  narrative: 'Some story',
  steps: [
    {
      options: [
        {
          copy: 'Option 1',
        },
        {
          copy: 'Option 2',
          steps: [
            {
              options: [
                {
                  copy: 'Step 2.1',
                  steps: [
                    {
                      options: [
                        {
                          copy: 'Option 2.1.1'
                        }
                      ]
                    }
                  ],
                },
                {
                  copy: 'Step 2.2'
                }
              ],
            }
          ]
        },
      ]
    }
  ],
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
