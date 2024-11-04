<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router';
import DataTable, { type DataTableRowSelectEvent } from 'primevue/datatable'
import { useDailyScenarioStore } from '@/store/dailyScenario';
import { Scenario } from '@/types/Scenario';
import { useDailyAdventureRequests } from '@/composables/useDailyAdventureRequests';

type Props = {
}

defineProps<Props>()

const router = useRouter();

const dailyScenarioStore = useDailyScenarioStore();

const scenarios = ref<Scenario[]>([]);
const scenarioRequests = useDailyAdventureRequests();
scenarioRequests.all()
  .then(({ data }) => {
    scenarios.value = data.scenarios;
    dailyScenarioStore.setScenarios(scenarios.value);
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

        <Column header="Completed?">
          <template #body>
            lkjsdf
          </template>
        </Column>
      </DataTable>

      <div v-for="scenario in scenarios" :key="`scenario-${scenario.id}`">
        {{ scenario }}
      </div>
    </div>

  </div>
</template>

<style scoped></style>
