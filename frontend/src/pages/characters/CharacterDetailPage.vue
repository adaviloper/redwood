<script setup lang="ts">
import { onMounted, ref } from 'vue';
import Inventory from '@/components/Inventory.vue';
import AbilityScoreBlock from '@/components/AbilityScoreBlock.vue';
import type { AxiosResponse } from 'axios';
import type { Nullable } from '@/types/utilities';
import { useRouter } from 'vue-router';
import { type ShowPlayerCharacterResponse, usePlayerCharacterRequests } from '@/composables/usePlayerCharacterRequests';
import type { PlayerCharacter } from '@/types/PlayerCharacter';

interface Props {
  id: string;
}

const router = useRouter();
const props = defineProps<Props>();
const playerCharacter = ref<Nullable<PlayerCharacter>>(null);

onMounted(() => {
  console.log('CharacterDetailPage.vue:19');
  const playerCharacterRequests = usePlayerCharacterRequests();
  playerCharacterRequests.find(parseInt(props.id))
    .then(({ data }: AxiosResponse<ShowPlayerCharacterResponse>) => {
      playerCharacter.value = data.player_character;
    })
    .catch(() => {
      router.push({ name: 'home' })
    });
});
</script>

<template>
  <div v-if="playerCharacter">
    <div class="p-4 mx-auto prose md:px-6 prose-indigo sm:rounded-md">
      <h2>{{ playerCharacter.character.name }} ({{ playerCharacter.hp }}/{{playerCharacter.max_hp }})</h2>

      <AbilityScoreBlock :abilities="playerCharacter.abilities" />

      <Inventory :items="playerCharacter.inventory" />
    </div>
  </div>
</template>
