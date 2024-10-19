<script setup lang="ts">
import { FormKit } from '@formkit/vue';

type Action = {
  type: 'roll',
  dice: 'd4' | 'd6' | 'd8' | 'd10' | 'd12' | 'd20'
  ability: 'strength' | 'constitution' | 'dexterity' | 'wisdom' | 'intelligence' | 'charisma'
};

type Props = {
  action: Action;
};

defineProps<Props>();
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
        :options="[
          {
            value: 'strength',
            label: 'Strength',
          },
          {
            value: 'dexterity',
            label: 'Dexterity',
          },
          {
            value: 'constitution',
            label: 'Constitution',
          },
          {
            value: 'wisdom',
            label: 'Wisdom',
          },
          {
            value: 'intelligence',
            label: 'Intelligence',
          },
          {
            value: 'charisma',
            label: 'Charisma',
          },
        ]"
      />

    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
