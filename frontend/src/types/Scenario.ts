import type { Nullable } from "./utilities";

export type StepId = string;

export type Step = {
  label: string;
  copy: string;
  type: 'step' | 'option';
  options?: Option[];
  next?: StepId;
};

export type StepsList = {
  [key: StepId]: Step;
};

export type Option = {
  copy: Nullable<string>;
  next?: StepId;
};

export type ScenarioId = string | number;

export type Scenario = {
  id: ScenarioId;
  date: string;
  narrative: string;
  steps: StepsList;
  startingStep: StepId;
};
