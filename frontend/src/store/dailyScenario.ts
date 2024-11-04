import type { Roll, Scenario, ScenarioId, Step, StepId } from '@/types/Scenario';
import type { Nullable } from '@/types/utilities';
import { defineStore } from 'pinia';

type StepMap = Record<StepId, Step & { result?: number }>;

interface State {
  _scenarios: Scenario[];
  _scenario: Nullable<Scenario>;
  _hasStarted: boolean;
  _stepMap: Record<ScenarioId, StepMap>;
  _rolls: Record<ScenarioId, Roll[]>;
}

export const useDailyScenarioStore = defineStore('daily-scenario', {
  state: (): State => ({
    _scenarios: [],
    _scenario: null,
    _hasStarted: false,
    _stepMap: {},
    _rolls: {},
  }),

  actions: {
    setScenarios(scenarios: Scenario[]) {
      this._scenarios = scenarios;

      return this._scenario;
    },

    setScenario(scenario: Scenario) {
      this._scenario = scenario;
      if (!this._rolls[`${this._scenario.id}`]) {
        this._rolls[`${this._scenario.id}`] = [];
      }

      if (!this._stepMap[`${this._scenario.id}`]) {
        this._stepMap[`${this._scenario.id}`] = {};
      }

      this._stepMap[this._currentScenarioRecordIndex] = this._scenario
        .steps
        .reduce((acc: StepMap, step: Step) => {
          acc[`${step.id}`] = step;

          return acc
        }, this._stepMap[this._currentScenarioRecordIndex]);

      return this._scenario;
    },

    setStepResult(stepId: StepId, roll: Roll) {
      if (this._scenario === null) {
        return;
      }

      this._rolls[this._currentScenarioRecordIndex].push(roll);
      this._stepMap[this._currentScenarioRecordIndex][`${stepId}`].result = roll.total;
      const parent = this.getParentStep(stepId);
      if (parent) {
        this._stepMap[this._currentScenarioRecordIndex][`${parent.id}`].result = roll.total
      }
    },

    completeScenario() {
      const scenario = this._scenarios.find(scenario => scenario.id === this._scenario?.id);
      if (scenario) {
        scenario.complete = true;
      }
    },
  },

  getters: {
    getParentStep: (state) => {
      return (stepId: StepId) => {
        if (!state._scenario) return;
        const options = Object.values(state._stepMap[state._scenario.id])
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
        if (!this._scenario) return;
        return this._rolls[`${this._scenario.id}`].find(roll => roll.scenario_step_id === stepId);
      };
    },

    hasRolledFor(state): (stepId: StepId) => boolean {
      return (stepId) => {
        if (!state._scenario) return false;
        const parent = this.getParentStep(stepId);
        if (parent) {
          return !!state._stepMap[`${state._scenario.id}`][`${parent.id}`].result;
        }
        return !!state._stepMap[`${state._scenario.id}`][`${stepId}`].result;
      };
    },

    rolls: (state): Roll[] => {
      if (!state._scenario) return [];
      return state._rolls[state._scenario.id];
    },

    _currentScenarioRecordIndex: (state) => {
      return `${state._scenario?.id}`;
    },

    scenarios(): Scenario[] {
      return this._scenarios;
    },

    scenario(): Scenario {
      return this._scenario as Scenario;
    },
  },
});
