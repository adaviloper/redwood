import type { Ability } from "./Ability";
import type { Item } from "./Item";

export interface Character {
  id: number;
  name: string;
  image_url: string;
  class: string;
  hp: number;
  max_hp: number;
  abilities: Ability[];
  inventory: Item[];
  description: string;
}
