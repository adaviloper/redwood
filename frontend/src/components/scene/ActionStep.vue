<script setup lang="ts">
import { ref } from 'vue';
import type { TActionStep } from '@/types/Scenario';
import Button from 'primevue/button';
import type { Nullable } from '@/types/utilities';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import type { AbilityName } from '@/types/Ability';

type Props = {
  step: TActionStep;
};

defineProps<Props>();
const pcStore = usePlayerCharacterStore();

const playerCharacter = pcStore.selectedPlayerCharacter;

const modifier = (name: AbilityName) => {
  return playerCharacter?.abilities.find(ability => ability.name === name)
};

const rollResult= ref<Nullable<number>>(null);

const select = () => {
  rollResult.value = Math.ceil(Math.random() * 20);
};
</script>

<template>
  <div>
    <p>
      {{ step.copy }}
    </p>
    <p>
      {{ step.action.type.charAt(0).toUpperCase() + step.action.type.slice(1) }} a {{ step.action.dice }} + [{{ step.action.ability.slice(0, 3).toUpperCase() }}]
    </p>

      <div
        v-if="step.type === 'step' && rollResult"
      >
        {{ rollResult }} + {{ modifier(step.action.ability)?.value }} = {{ rollResult + (modifier(step.action.ability)?.value || 0) }}
      </div>

      <Button
        type="button"
        severity="info"
        @click="select()"
      >
        Select
      </Button>

  </div>
</template>

<style scoped>

</style>
