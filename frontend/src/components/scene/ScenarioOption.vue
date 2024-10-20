<script setup lang="ts">
import { ref } from 'vue';
import type { Step } from '@/types/Scenario';
import Button from 'primevue/button';

type Props = {
  step: Step;
};

const selected = ref<boolean>(false);
const select = () => {
  selected.value = true;
};

defineProps<Props>();
</script>

<template>
  <div>
    {{ step.copy }}
    <Button :class="`select-options-${step.id}`" @click="select">Select</Button>
    <div
      v-if="selected || !step.scenario_step_id"
      class="ml-4"
    >
      <div
        v-for="(option, index) in step.options"
        :key="`option-${index}`"
      >
        {{ option.reference }}
        <Button type="submit">Select</Button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>

