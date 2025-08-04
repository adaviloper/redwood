import type { PlayerCharacter } from "@/types/PlayerCharacter";
import { destroyRequest, indexRequest, showRequest, storeRequest, updateRequest } from "./requestFactory";

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

export interface DestroyPlayerCharacterResponse {
}

export function usePlayerCharacterRequests() {
  return {
    all: indexRequest<PlayerCharacterIndexResponse>('/player-characters'),

    find: showRequest<ShowPlayerCharacterResponse>('/player-characters'),

    create: storeRequest<StorePlayerCharacterResponse, StorePlayerCharacterRequest>('/player-characters'),

    update: updateRequest<StorePlayerCharacterResponse, StorePlayerCharacterRequest>('/player-characters'),

    destroy: destroyRequest<DestroyPlayerCharacterResponse>('/player-characters'),
  }
}
