import type { Nullable } from "./utilities";

export type Step = {
  options: [Option] | Option[];
};

export type Option = {
  copy?: Nullable<string>;
  steps?: Nullable<Step[]>;
};

export type Scenario = {
  narrative: string;
  steps: Step[];
};
