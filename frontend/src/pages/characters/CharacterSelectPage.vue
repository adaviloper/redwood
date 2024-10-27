<script setup lang="ts">
import { onMounted, ref } from 'vue';
import type { AxiosResponse } from "axios"
import type { Character } from '@/types/Character';
import CharacterSelectCard from '@/components/characterSelect/CharacterSelectCard.vue';
import { type CharacterResponse, useCharacterRequests } from '@/composables/useCharacterRequests';

const characters = ref<Character[]>([] as Character[]);

onMounted(() => {
  const characterRequests = useCharacterRequests();
  characterRequests.all()
    .then(({ data }: AxiosResponse<CharacterResponse>) => {
      characters.value = data.characters;
    });
});
</script>

<template>
  <div class="px-6">
    <h1 class="text-4xl">Characters</h1>

    <div class="columns-3">
      <div
        v-for="character in characters"
        :key="`character-${character.name}`"
      >
        <CharacterSelectCard
          :character="character"
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
