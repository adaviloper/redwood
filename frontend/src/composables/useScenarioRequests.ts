import type { Scenario } from "@/types/Scenario";
import axiosInstance from "@/utilities/api"
import type { AxiosResponse } from "axios"

export interface PlayerCharacterIndexResponse {
  player_characters: Scenario[];
}

export interface ShowPlayerCharacterResponse {
  scenario: Scenario;
}

export interface StorePlayerCharacterRequest {
  character_id: number;
}

export interface StorePlayerCharacterResponse {
  scenario: Scenario;
}

export function usePlayerCharacterRequests() {
  return {
    all(): Promise<AxiosResponse<PlayerCharacterIndexResponse>> {
      return axiosInstance.get('/scenarios')
    },
    find(id: number): Promise<AxiosResponse<ShowPlayerCharacterResponse>> {
      return axiosInstance.get(`/scenarios/${id}`)
    },
    create(payload: StorePlayerCharacterRequest): Promise<AxiosResponse<StorePlayerCharacterResponse>> {
      return axiosInstance.post('/scenarios', {
        character_id: payload.character_id
      })
    },
  }
}
