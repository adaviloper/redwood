import type { Roll, Scenario, ScenarioId } from '@/types/Scenario'
import axiosInstance from '@/utilities/api'
import type { AxiosResponse } from 'axios'
import { format } from 'date-fns';

export type ShowDailyAdventureListRequest = {
  playerCharacterId: number;
};

export type ShowDailyAdventureListResponse = {
  scenarios: Scenario[];
  rolls: Record<ScenarioId, Roll[]>;
};

export type ShowDailyAdventureResponse = {
  scenario: Scenario;
  progress: null;
};

export type StoreRollRequest = {
  rolls: Roll[];
};

export type StoreRollResponse = {
  rolls: Roll[];
};

export function useDailyAdventureRequests() {
  return {
    all({ playerCharacterId }: ShowDailyAdventureListRequest): Promise<AxiosResponse<ShowDailyAdventureListResponse>> {
      return axiosInstance.get('/scenarios/daily/', {
        params: {
          player_character_id: playerCharacterId,
        }
      });
    },

    daily(): Promise<AxiosResponse<ShowDailyAdventureResponse>> {
      const today = format(new Date(), 'yyyy-MM-dd');
      return axiosInstance.get('/scenarios/daily/' + today);
    },

    create(payload: StoreRollRequest): Promise<AxiosResponse<StoreRollResponse>> {
      return axiosInstance.post('/scenarios/daily', {
        rolls: payload.rolls,
      });
    },
  }
}
