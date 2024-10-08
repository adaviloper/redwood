<script setup lang="ts">
// import { useRouter } from 'vue-router';
import type { PlayerCharacter } from '@/types/PlayerCharacter';

interface Props {
  playerCharacter: PlayerCharacter;
}

defineProps<Props>();
// const router = useRouter();

</script>

<template>
  <div>
    <ImageCard
      :image-url="playerCharacter.character.image_url"
    >
      <div>
        <span class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">
          {{ playerCharacter.character.class }}
        </span>

        <a
          href="#"
          class="block mt-2 text-xl font-semibold transition-colors duration-300 transform hover:text-gray-600 hover:underline"
          tabindex="0"
          role="link"
        >
          {{ playerCharacter.character.name }}
        </a>

        <AbilityScoreBlock
          :abilities="playerCharacter.abilities"
        />

        <p>{{ playerCharacter.character.description }}</p>
      </div>
    </ImageCard>
  </div>
</template>
