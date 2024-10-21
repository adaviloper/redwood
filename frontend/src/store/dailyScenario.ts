import { useScenarioRequests, type ShowScenarioResponse } from '@/composables/useScenarioRequests';
import type { Roll, Scenario, Step, StepId } from '@/types/Scenario';
import type { Nullable } from '@/types/utilities';
import type { AxiosResponse } from 'axios';
import { defineStore } from 'pinia';

type StepMap = Record<StepId, Step & { result?: number }>;

interface State {
  _scenario: Nullable<Scenario>;
  _hasStarted: boolean;
  _stepMap: StepMap;
  _rolls: Roll[];
}

export const useDailyScenarioStore = defineStore('daily-scenario', {
  state: (): State => ({
    _scenario: null,
    _hasStarted: false,
    _stepMap: {} as StepMap,
    _rolls: [],
  }),

  actions: {
    setScenario() {
      if (this._scenario !== null) {
        return
      }
      const scenarioRequests = useScenarioRequests();
      scenarioRequests.daily()
        .then(({ data }: AxiosResponse<ShowScenarioResponse>) => {
          this._scenario = data.scenario
          this._stepMap = this._scenario.steps.reduce((acc: StepMap, step: Step) => {
            acc[`${step.id}`] = step;

            return acc
          }, this._stepMap);
        });
    },

    setStepResult(stepId: StepId, roll: Roll) {
      this._rolls.push(roll);
      this._stepMap[`${stepId}`].result = roll.total;
      const parent = this.getParentStep(stepId);
      console.log('dailyScenario', roll);
      if (parent) {
        this._stepMap[`${parent.id}`].result = roll.total
      }
    },
  },

  getters: {
    getParentStep: (state) => {
      return (stepId: StepId) => {
        const options = Object.values(state._stepMap)
        .filter(step => step.type === 'option')
        if (options.length > 0) {
          const parentStep = options.find(step => {
            return step.options.find(option => option.reference === stepId)
          });
          if (parentStep) {
            return parentStep;
          }
        }
      };
    },

    getRollFor(): (stepId: StepId) => Roll | undefined {
      return (stepId) => {
        return this._rolls.find(roll => roll.step_id === stepId);
      };
    },

    hasRolledFor(state): (stepId: StepId) => boolean {
      return (stepId) => {
        const parent = this.getParentStep(stepId);
        if (parent) {
          return !!state._stepMap[`${parent.id}`].result;
        }
        return !!state._stepMap[`${stepId}`].result;
      };
    },

    scenario(): Nullable<Scenario> {
      return this._scenario;
    },
  },
});
