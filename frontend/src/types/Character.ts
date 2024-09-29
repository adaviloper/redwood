export interface Item {
  name: string;
  quantity: number;
}

export interface Ability {
  name: string;
  type: string;
  value: number;
}

export interface Character {
  name: string;
  imageUrl: string;
  class: string;
  hp: number;
  maxHp: number;
  abilities: Ability[];
  inventory: Item[];
}
