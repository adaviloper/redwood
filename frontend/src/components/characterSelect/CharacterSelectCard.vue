<script setup lang="ts">
import type { Character } from '@/types/Character';
import axiosInstance from '@/utilities/api';

interface Props {
  character: Character;
}
const props = defineProps<Props>();

const selectCharacter = () => {
  axiosInstance.post('character/select', {
    ...props.character
  })
};
</script>

<template>
  <div>
    <ImageCard
      :image-url="character.imageUrl"
    >
      <FormKit
        type="form"
        @submit="selectCharacter"
      >
      <div>
        <span class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">
          {{ character.class }}
        </span>
        <a
          href="#"
          class="block mt-2 text-xl font-semibold transition-colors duration-300 transform hover:text-gray-600 hover:underline"
          tabindex="0"
          role="link"
        >
          {{ character.name }}
        </a>

        <AbilityScoreBlock
          :ability="character.abilities"
        />
      </div>
      </FormKit>
    </ImageCard>
  </div>
</template>
