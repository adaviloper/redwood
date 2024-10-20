<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import type { Scenario, ScenarioId } from '@/types/Scenario';
import { useScenarioRequests } from '@/composables/useScenarioRequests';
import type { Nullable } from '@/types/utilities';
import { FormKit } from '@formkit/vue';
import { type FormKitGroupValue } from '@formkit/core';
import { v4 as uuidV4 } from 'uuid';

type Props = {
  scenarioId: ScenarioId;
};

const scenarioRequests = useScenarioRequests();
const scenario = ref<Nullable<Scenario>>(null);

const props = defineProps<Props>();
watch(props, () => {});

onMounted(async () => {
  scenarioRequests.find(props.scenarioId)
    .then(({ data }) => {
      scenario.value = data.scenario;
    });
});

const updateScenario = (data: Partial<Scenario>) => {
  scenarioRequests.update({
    scenarioId: props.scenarioId,
    data,
  });
};

const stepTypes = [
  {
    label: 'Step',
    value: 'step',
  },
  {
    label: 'Option',
    value: 'option',
  },
];

</script>

<template>
  <div class="px-6">
    <FormKit
      v-if="scenario"
      v-slot="{ value }"
      type="form"
      @submit="updateScenario"
    >
      <FormKit
        v-model="scenario.date"
        type="text"
        name="date"
        label="Date"
      />

      <FormKit
        v-model="scenario.narrative"
        rows="8"
        type="textarea"
        name="narrative"
        label="Narrative"
        validation="required|string"
      />

      <div>
        <FormKit
          id="step-repeater"
          v-slot="{ value: currentStep, index }"
          name="steps"
          type="repeater"
          label="Steps"
          :value="scenario.steps"
          :insert-control="true"
          :remove-control="false"
        >

          <FormKit
            type="hidden"
            name="id"
            :value="uuidV4()"
          />

          <FormKit
            type="dropdown"
            name="type"
            label="Type"
            value="step"
            :options="stepTypes"
          />

          <FormKit
            type="text"
            label="Description"
            name="copy"
            placeholder="What are we doing here?"
          />


          <ScenarioStepRepeater
            :root-repeater-values="value as FormKitGroupValue"
            :current-step="currentStep"
            :order="index + 1"
          />
        </FormKit>
      </div>

    </FormKit>
  </div>
</template>

<style lang="postcss" scoped>

</style>

