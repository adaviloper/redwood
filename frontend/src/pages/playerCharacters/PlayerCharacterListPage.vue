<script setup lang="ts">
import { computed, onMounted } from 'vue';
import type { AxiosResponse } from "axios"
import { type PlayerCharacterIndexResponse, usePlayerCharacterRequests } from '@/composables/usePlayerCharacterRequests';
import type { PlayerCharacter } from '@/types/PlayerCharacter';
import PlayerCharacterSelectCard from '@/components/playerCharacter/PlayerCharacterSelectCard.vue';
import { usePlayerCharacterStore } from '@/store/playerCharacter';

const store = usePlayerCharacterStore();

const playerCharacters = computed<PlayerCharacter[]>(() => store._playerCharacters);

onMounted(() => {
  const characterRequests = usePlayerCharacterRequests();
  characterRequests.all()
    .then(({ data }: AxiosResponse<PlayerCharacterIndexResponse>) => {
      store.setPlayerCharacters(data.player_characters)
    });
});
</script>

<template>
  <div class="px-6">
    <h1 class="text-4xl">Characters</h1>

    <div class="columns-3">
      <div
        v-for="playerCharacter in playerCharacters"
        :key="`character-${playerCharacter.character.name}`"
      >
        <PlayerCharacterSelectCard
          :player-character="playerCharacter"
        />
      </div>
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.card-component + .card-component {
  @apply my-4 dark:bg-gray-800
}
</style>
