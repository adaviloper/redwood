<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter } from 'vue-router';
import DataTable, { type DataTableRowSelectEvent } from 'primevue/datatable'
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

const startAdventure = (event: DataTableRowSelectEvent) => {
  const scenario = event.data as Scenario;
  console.log('DailyScenarioList.vue:28', scenario);
  dailyScenarioStore.setScenario(scenario);
  router.push({ name: 'daily-adventure', params: { date: scenario.date } })
};
</script>

<template>
  <div class="content-center p-6">
    <div class="">
      <DataTable
        :value="scenarios"
        size="large"
        striped-rows
        selection-mode="single"
        @row-select="startAdventure"
      >
        <Column field="date" header="Date" />

        <Column field="complete" header="Complete?">
          <template #body="{ data }">
            <FormKit
              type="checkbox"
              decorator-icon="check"
              :value="data.complete"
            />
          </template>
        </Column>
      </DataTable>
    </div>

  </div>
</template>

<style scoped></style>
