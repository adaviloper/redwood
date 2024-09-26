import type { Character } from "@/types/Character";

export const character: Character = {
  name: "Ren",
  hp: 12,
  maxHp: 12,
  stats: [
    { name: 'Strength', value: 10 },
    { name: 'Constitution', value: 10 },
    { name: 'Dexterity', value: 10 },
    { name: 'Wisdom', value: 10 },
    { name: 'Intelligence', value: 10 },
    { name: 'Charisma', value: 10 },
  ],
  inventory: [
    { name: 'Health Potion', quantity: 1 },
    { name: 'Mana Potion', quantity: 3 },
  ]
};
