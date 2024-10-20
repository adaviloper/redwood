import type { AbilityName } from "./Ability";
import type { Nullable } from "./utilities";

export type StepId = string;

export type HitDice = 'd4' | 'd6' | 'd8' | 'd10' | 'd12' | 'd20'

export type Action = {
  type: 'roll';
  dice: HitDice;
  ability: AbilityName;
};

export type Option = {
  reference: StepId;
};

export type TActionStep = {
  id: StepId;
  copy: string;
  type: 'step';
  action: Action;
  scenario_step_id: Nullable<StepId>;
}

export type OptionStep = {
  id: StepId;
  copy: string;
  type: 'option';
  options: Option[];
  scenario_step_id: Nullable<StepId>;
}

export type Step = TActionStep | OptionStep;;

export type ScenarioId = string | number;

export type Scenario = {
  id: ScenarioId;
  date: string;
  narrative: string;
  steps: Step[];
};
