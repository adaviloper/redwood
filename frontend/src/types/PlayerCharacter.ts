import type { Ability } from "./Ability";
import type { Character } from "./Character";
import type { Item } from "./Item";

export interface PlayerCharacter {
  id: number;
  user_id: number;
  character_id: number;
  character: Character;
  hp: number;
  max_hp: number;
  abilities: Ability[];
  inventory: Item[];
}
