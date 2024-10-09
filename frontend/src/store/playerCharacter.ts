import type { PlayerCharacter } from '@/types/PlayerCharacter';
import type { Nullable } from '@/types/utilities';
import { defineStore } from 'pinia'

interface State {
  _playerCharacters: PlayerCharacter[];
  _selectedPlayerCharacter: Nullable<PlayerCharacter>;
}

export const usePlayerCharacterStore = defineStore('player-character', {
  state: (): State => ({
    _playerCharacters: [],
    _selectedPlayerCharacter: null,
  }),
  actions: {
    setPlayerCharacters(playerCharacters: PlayerCharacter[]) {
      console.log('typescript', playerCharacters);
      this._playerCharacters = playerCharacters;
    },
    selectPlayerCharacter(id: number) {
      const pc = this._playerCharacters.find(pc => pc.id === id);
      this._selectedPlayerCharacter = pc || null;
    },
  },
  getters: {
    playerCharacters: (state) => {
      return state._playerCharacters;
    },
    selectedPlayerCharacter: (state) => {
      return state._selectedPlayerCharacter;
    },
  },
});
