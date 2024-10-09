export type AbilityName = 'strength' | 'dexterity' | 'constitution' | 'wisdom' | 'charisma' | 'intelligence';
export interface Ability {
  name: AbilityName;
  type: string;
  value: number;
}
