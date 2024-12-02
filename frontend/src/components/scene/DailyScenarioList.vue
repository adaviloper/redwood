<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router';
import DataTable from 'primevue/datatable'
import { useDailyScenarioStore } from '@/store/dailyScenario';
import { type Scenario } from '@/types/Scenario';
import { useDailyAdventureRequests } from '@/composables/useDailyAdventureRequests';
import { usePlayerCharacterStore } from '@/store/playerCharacter';

type Props = {
}

defineProps<Props>()

const router = useRouter();

const dailyScenarioStore = useDailyScenarioStore();
const playerCharacterStore = usePlayerCharacterStore();

const scenarios = computed(() => {
  return dailyScenarioStore.scenarios;
});
const scenarioRequests = useDailyAdventureRequests();

onMounted(() => {
  if (!playerCharacterStore.selectedPlayerCharacter === null) {
    router.push({ name: 'player-character-list' });
  }
  if (!dailyScenarioStore.scenarios.length) {
    scenarioRequests.all({ playerCharacterId: playerCharacterStore.selectedPlayerCharacter.id })
      .then(({ data }) => {
        dailyScenarioStore.setScenarios(data.scenarios);
        dailyScenarioStore.setRolls(data.rolls);
      });
  }
});

const startAdventure = (scenario: Scenario) => {
  console.log('DailyScenarioList.vue:28', scenario);
  dailyScenarioStore.setScenario(scenario);
  router.push({ name: 'daily-adventure', params: { date: scenario.date } })
};

const canBegin = (scenario: Scenario) => {
  const scenarioIndex = scenarios.value.findIndex(storedScenario => storedScenario.id === scenario.id);
  if (scenarioIndex === -1) {
    return false;
  }

  if (scenarioIndex === scenarios.value.length - 1) {
    return true;
  }

  const precedingScenarios = scenarios.value.slice(scenarioIndex + 1);

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
