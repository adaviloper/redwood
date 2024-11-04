<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter } from 'vue-router';
import DataTable from 'primevue/datatable'
import { useDailyScenarioStore } from '@/store/dailyScenario';
import { type Scenario } from '@/types/Scenario';
import { useDailyAdventureRequests } from '@/composables/useDailyAdventureRequests';

type Props = {
}

defineProps<Props>()

const router = useRouter();

const dailyScenarioStore = useDailyScenarioStore();

const scenarios = dailyScenarioStore.scenarios;
const scenarioRequests = useDailyAdventureRequests();

onMounted(() => {
  if (!dailyScenarioStore.scenarios.length) {
    scenarioRequests.all()
      .then(({ data }) => {
        dailyScenarioStore.setScenarios(data.scenarios);
      });
  }
});

const startAdventure = (scenario: Scenario) => {
  console.log('DailyScenarioList.vue:28', scenario);
  dailyScenarioStore.setScenario(scenario);
  router.push({ name: 'daily-adventure', params: { date: scenario.date } })
};

const canBegin = (scenario: Scenario) => {
  const scenarioIndex = scenarios.findIndex(storedScenario => storedScenario.id === scenario.id);
  if (scenarioIndex === -1) {
    return false;
  }

  if (scenarioIndex === scenarios.length - 1) {
    return true;
  }

  const precedingScenarios = scenarios.slice(scenarioIndex + 1);

  return !precedingScenarios.some(precedingScenario => !precedingScenario.complete);
};
</script>

<template>
  <div class="content-center p-6">
    <div class="">
      <DataTable
        :value="scenarios"
        size="large"
        striped-rows
      >
        <Column field="date" header="Date" />

        <Column field="complete" header="Complete?">
          <template #body="{ data: scenario }">
            <FormKit
              v-if="scenario.complete"
              type="checkbox"
              decorator-icon="check"
              :value="scenario.complete"
            />

            <FormKit
              v-else
              :disabled="!canBegin(scenario)"
              type="button"
              label="Begin"
              @click="startAdventure(scenario)"
            />
          </template>
        </Column>
      </DataTable>
    </div>

  </div>
</template>

<style scoped></style>
