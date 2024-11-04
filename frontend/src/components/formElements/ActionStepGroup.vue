<script setup lang="ts">
import { useAbilityConstants } from '@/composables/useAbilityConstants';
import type { Action } from '@/types/Scenario';

type Props = {
  action: Action;
};

defineProps<Props>();

const abilityConstants = useAbilityConstants();
</script>

<template>
  <div>
    <div
      class="flex flex-row gap-4"
    >
      <FormKit
        type="dropdown"
        label="Type"
        name="type"
        :value="action?.type"
        :options="[
          {
            value: 'roll',
            label: 'Roll',
          },
        ]"
      />

      <FormKit
        type="dropdown"
        label="Dice"
        :value="action.dice"
        name="dice"
        :options="[
          {
            value: 'd4',
            label: 'D4',
          },
          {
            value: 'd6',
            label: 'D6',
          },
          {
            value: 'd8',
            label: 'D8',
          },
          {
            value: 'd10',
            label: 'D10',
          },
          {
            value: 'd12',
            label: 'D12',
          },
          {
            value: 'd20',
            label: 'D20',
          },
        ]"
      />

      <FormKit
        type="dropdown"
        label="Ability"
        name="ability"
        :value="action.ability"
        :options="abilityConstants.dropdownOptions()"
      />

    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
