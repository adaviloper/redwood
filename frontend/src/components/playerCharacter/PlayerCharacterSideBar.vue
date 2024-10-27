<script setup lang="ts">
import type { Ability, AbilityName } from '@/types/Ability';
import type { PlayerCharacter } from '@/types/PlayerCharacter';
import type { Nullable } from '@/types/utilities';
import Card from 'primevue/card';
import Image from 'primevue/Image';

interface Props {
  playerCharacter: PlayerCharacter
}

const props = defineProps<Props>();

const getAbility = (abilityName: AbilityName): Nullable<Ability> => {
  const ability = props.playerCharacter.abilities.find(ability => ability.name === abilityName);
  if (ability === undefined) {
    return null;
  }
  return ability;
}
</script>

<template>
  <div>
    <Card>
      <template #title>{{ playerCharacter.character.name }}</template>

      <template #content>
        <div class="flex flex-row">
          <div class="flex-1 text-center">
            <div>
              {{ playerCharacter.hp }} / {{ playerCharacter.max_hp }}
            </div>

            <div>
              {{ playerCharacter.max_hp }}
            </div>

            <div>
              STR: {{ getAbility('strength')?.value }}
            </div>

            <div>
              CON: {{ getAbility('constitution')?.value }}
            </div>

            <div>
              DEX: {{ getAbility('dexterity')?.value }}
            </div>
          </div>

          <div class="flex-[2]">
            <Image :src="playerCharacter.character.image_url" />
          </div>

          <div class="flex-1 text-center">
            <div class="w-full">
              {{ playerCharacter.hp }}
            </div>

            <div>
              {{ playerCharacter.max_hp }}
            </div>

            <div>
              WIS: {{ getAbility('wisdom')?.value }}
            </div>

            <div>
              INT: {{ getAbility('intelligence')?.value }}
            </div>

            <div>
              CHA: {{ getAbility('charisma')?.value }}
            </div>
          </div>
        </div>
      </template>
    </Card>
  </div>
</template>
