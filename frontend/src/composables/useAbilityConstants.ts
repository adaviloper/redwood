import type { AbilityName } from "@/types/Ability";

type DropdownOption = {
  value: AbilityName;
  label: Capitalize<AbilityName>;
};

export function useAbilityConstants() {
  const abilities: AbilityName[] = [
    'strength',
    'constitution',
    'dexterity',
    'wisdom',
    'intelligence',
    'charisma',
  ];

  return {
    labels(): string[] {
      return abilities;
    },

    dropdownOptions(): DropdownOption[] {
      return abilities.map((ability: AbilityName) => {
        return {
          label: ability.charAt(0).toUpperCase() + ability.slice(1) as Capitalize<AbilityName>,
          value: ability,
        };
      });
    }
  };
}
