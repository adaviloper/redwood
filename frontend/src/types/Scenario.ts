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

export type TOptionStep = {
  id: StepId;
  copy: string;
  type: 'option';
  options: Option[];
  scenario_step_id: Nullable<StepId>;
}

export type Step = TActionStep | TOptionStep;;

export type ScenarioId = string | number;

export type Bonus = {
  value: number;
};

export type Roll = {
  step_id: StepId;
  total: number;
  dieResult: number;
  ability: AbilityName;
  modifierValue: number;
  bonuses: Bonus[];
};

export type Scenario = {
  id: ScenarioId;
  date: string;
  narrative: string;
  steps: Step[];
};
