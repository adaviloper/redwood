import type { PlayerCharacter } from "@/types/PlayerCharacter";
import axiosInstance from "@/utilities/api"
import type { AxiosResponse } from "axios"

export interface PlayerCharacterIndexResponse {
  player_characters: PlayerCharacter[];
}

export interface ShowPlayerCharacterResponse {
  player_character: PlayerCharacter;
}

export interface StorePlayerCharacterRequest {
  character_id: number;
}

export interface StorePlayerCharacterResponse {
  player_character: PlayerCharacter;
}

export function usePlayerCharacterRequests() {
  return {
    all(): Promise<AxiosResponse<PlayerCharacterIndexResponse>> {
      return axiosInstance.get('/player-characters')
    },
    find(id: number): Promise<AxiosResponse<ShowPlayerCharacterResponse>> {
      return axiosInstance.get(`/player-characters/${id}`)
    },
    create(payload: StorePlayerCharacterRequest): Promise<AxiosResponse<StorePlayerCharacterResponse>> {
      return axiosInstance.post('/player-characters', {
        character_id: payload.character_id
      })
    },
  }
}
