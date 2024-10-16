<script setup lang="ts">
import { onMounted, ref } from 'vue';
import type { Scenario } from '@/types/Scenario';
import { useScenarioRequests } from '@/composables/useScenarioRequests';
import type { Nullable } from '@/types/utilities';
import type { DataTableRowSelectEvent } from 'primevue/datatable';
import { useRouter } from 'vue-router';

const router = useRouter();

const scenarios = ref<Nullable<Scenario[]>>(null);
const scenarioRequests = useScenarioRequests();

onMounted(() => {
  scenarioRequests.all()
    .then(({ data }) => {
      scenarios.value = data.scenarios;
    });
});

const selectScenario = (event: DataTableRowSelectEvent) => {
  const data: Scenario = event.data;
  router.push({
    name: 'admin.scenarios.edit',
    params: {
      scenarioId: data.id,
    },
  });
};
</script>

<template>
  <div class="px-6">
    <DataTable :value="scenarios" selection-mode="single" @row-select="selectScenario">
      <Column field="date" header="Date"></Column>
    </DataTable>
  </div>
</template>

<style lang="postcss" scoped>

</style>

