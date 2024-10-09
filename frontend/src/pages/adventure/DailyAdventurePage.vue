<script setup lang="ts">
import Scene from '@/components/scene/Scene.vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import { useRouter } from 'vue-router';

const store = usePlayerCharacterStore();
const router = useRouter();

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
      <div class="grow-[4] bg-sky-50 place-items-center">
        <Scene />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
