import type { Character } from "@/types/Character"
import axiosInstance from "@/utilities/api"
import type { AxiosResponse } from "axios"

export interface CharacterResponse {
  characters: Character[];
}

export function useCharacterRequests() {
  return {
    all(): Promise<AxiosResponse<CharacterResponse>> {
      return axiosInstance.get('/characters')
    },
    find(id: number): Promise<AxiosResponse<Character>> {
      return axiosInstance.get(`/characters/${id}`)
    },
  }
}
