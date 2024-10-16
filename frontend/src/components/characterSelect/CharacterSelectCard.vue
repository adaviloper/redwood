<script setup lang="ts">
import { useRouter } from 'vue-router';
import type { Character } from '@/types/Character';
import type { AxiosResponse } from 'axios';
import { usePlayerCharacterRequests, type StorePlayerCharacterResponse } from '@/composables/usePlayerCharacterRequests';

interface Props {
  character: Character;
}

const props = defineProps<Props>();
const router = useRouter();

const selectCharacter = () => {
  const playerCharacterRequests = usePlayerCharacterRequests();
  playerCharacterRequests.create({ character_id: props.character.id })
    .then((response: AxiosResponse<StorePlayerCharacterResponse>) => {
      router.push({
        name: 'player-character-detail',
        params: {
          id: response.data.player_character.id
        }
      });
    })
};
</script>

<template>
  <div>
    <ImageCard
      :image-url="character.image_url"
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
            v-if="character.abilities"
            :abilities="character.abilities"
          />

          <p>{{ character.description }}</p>
        </div>
      </FormKit>
    </ImageCard>
  </div>
</template>
