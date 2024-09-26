export interface Item {
  name: string;
  quantity: number;
}

export interface Stat {
  name: string;
  value: number;
}

export interface Character {
  name: string;
  hp: number;
  maxHp: number;
  stats: Stat[];
  inventory: Item[];
}
