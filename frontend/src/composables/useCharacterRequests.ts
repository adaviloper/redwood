import type { Character } from "@/types/Character"
import { indexRequest, showRequest } from "./requestFactory";

export interface CharacterResponse {
  characters: Character[];
}

export function useCharacterRequests() {
  return {
    all: indexRequest<CharacterResponse>('/characters'),

    find: showRequest('/characters'),
  }
}
