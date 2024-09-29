<script setup lang="ts">
import type { AxiosResponse } from 'axios';
import { onMounted, ref } from 'vue';
import type { Character } from '@/types/Character';
import axiosInstance from '@/utilities/api';
import CharacterSelectCard from '@/components/characterSelect/CharacterSelectCard.vue';

interface CharacterResponse {
  characters: Character[];
}

const characters = ref<Character[]>([] as Character[]);

onMounted(() => {
  axiosInstance.get('/characters')
  .then(({ data }: AxiosResponse<CharacterResponse>) => {
      characters.value = data.characters;
    });
});
</script>

<template>
  <div class="px-6">
    <h1>Characters</h1>
    <div
      v-for="character in characters"
      :key="`character-${character.name}`"
    >
      <CharacterSelectCard
        :character="character"
      />
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.card-component + .card-component {
  @apply my-4 dark:bg-gray-800
}
</style>
