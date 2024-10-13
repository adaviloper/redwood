import type { Nullable } from "./utilities";

export type StepId = string;

export type Step = {
  label: string;
  copy: string;
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

export type Scenario = {
  narrative: string;
  steps: StepsList;
  startingStep: StepId;
};
