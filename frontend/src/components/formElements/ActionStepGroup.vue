<script setup>
import { FormKit } from '@formkit/vue';

</script>

<template>
  <div>
    <div
      class="flex flex-row gap-4"
    >
      <FormKit
        type="dropdown"
        label="Type"
        value="roll"
        name="type"
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
        value="d20"
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
        value="strength"
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
