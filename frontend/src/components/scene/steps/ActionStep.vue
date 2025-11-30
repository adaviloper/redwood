<script setup lang="ts">
import { computed, ref } from 'vue';
import type { TActionStep } from '@/types/Scenario';
import Button from 'primevue/button';
import type { Nullable } from '@/types/utilities';
import type { AbilityName } from '@/types/Ability';
import { usePlayerCharacterStore } from '@/store/playerCharacter';
import { useDailyScenarioStore } from '@/store/dailyScenario';

type Props = {
  step: TActionStep;
};

const props = defineProps<Props>();
const pcStore = usePlayerCharacterStore();
const dailyScenarioStore = useDailyScenarioStore();
defineEmits(['option-selected']);

const playerCharacter = pcStore.selectedPlayerCharacter;
const finalRoll = computed(() => {
  return dailyScenarioStore.getRollFor(props.step.id);
});

const modifier = (name: AbilityName) => {
  return playerCharacter?.abilities.find(ability => ability.name === name) ?? { name: 'NULL', type: 'NULL', value: 0 };
};

const rollResult = ref<Nullable<number>>(null);

const hasRolled = ref<boolean>(false);

const totalRoll = computed(() => {
  if (rollResult.value) {
    return rollResult.value + modifier(props.step.action.ability)?.value
  }

  return 0;
});

const select = () => {
  rollResult.value = Math.ceil(Math.random() * 20);
  hasRolled.value = true;
  dailyScenarioStore.setStepResult(props.step.id, {
    scenario_step_id: props.step.id,
    total: totalRoll.value,
    die_result: rollResult.value ?? 0,
    ability: props.step.action.ability,
    modifier_value: modifier(props.step.action.ability)?.value,
    bonuses: [],
    player_character_id: playerCharacter?.id
  });
};
</script>

<template>
  <div class="flex flex-row justify-between">
    <div>
      <p class="font-bold">
        {{ step.copy }}
      </p>

      <p>
        {{ step.action.type.charAt(0).toUpperCase() + step.action.type.slice(1) }} a {{ step.action.dice }} and add your [{{ step.action.ability.slice(0, 3).toUpperCase() }} ({{ modifier(step.action.ability)?.value }})] modifier
      </p>

      <div
        v-if="step.type === 'step' && finalRoll"
      >
        {{ finalRoll.die_result }} + {{ finalRoll.modifier_value }} = {{ finalRoll.total }}
      </div>
    </div>

    <div>
      <Button
        :class="`select-options-${step.id}`"
        type="button"
        severity="info"
        :disabled="dailyScenarioStore.hasRolledFor(step.id)"
        @click="select"
      >
        Select
      </Button>
    </div>

  </div>
</template>

<style scoped>

</style>
