import type { Roll } from '@/types/Scenario'
import axiosInstance from '@/utilities/api'
import type { AxiosResponse } from 'axios'

export type StoreRollRequest = {
  rolls: Roll[];
};

export type StoreRollResponse = {
  rolls: Roll[];
};

export function useDailyAdventureRequests() {
  return {
    create(payload: StoreRollRequest): Promise<AxiosResponse<StoreRollResponse>> {
      return axiosInstance.post('/scenarios/daily', {
        rolls: payload.rolls,
      })
    },
  }
}
