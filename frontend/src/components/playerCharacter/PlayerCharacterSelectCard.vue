<script setup lang="ts">
import { useRouter } from 'vue-router';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import type { PlayerCharacter } from '@/types/PlayerCharacter';
import Button from 'primevue/button';

interface Props {
  playerCharacter: PlayerCharacter;
}

const props = defineProps<Props>();
const router = useRouter();
const store = usePlayerCharacterStore();

const selectCharacter = () => {
  store.selectPlayerCharacter(props.playerCharacter.id)
  router.push({ name: 'daily-adventure' })
};
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

        <h2
          class="block mt-2 text-xl font-semibold transition-colors duration-300 transform hover:text-gray-600 hover:underline"
        >
          {{ playerCharacter.character.name }}
        </h2>

        <AbilityScoreBlock
          :abilities="playerCharacter.abilities"
        />

        <p>{{ playerCharacter.character.description }}</p>

        <Button @click="selectCharacter">Select</Button>
      </div>
    </ImageCard>
  </div>
</template>
