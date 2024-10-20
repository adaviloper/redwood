import type { Scenario, ScenarioId } from "@/types/Scenario";
import axiosInstance from "@/utilities/api"
import type { AxiosResponse } from "axios"

export interface ScenarioIndexResponse {
  scenarios: Scenario[];
}

export interface ShowScenarioResponse {
  scenario: Scenario;
}

export interface StoreScenarioRequest {
  scenario_id: ScenarioId;
}

export interface StoreScenarioResponse {
  scenario: Scenario;
}

export interface UpdateScenarioRequest {
  scenarioId: ScenarioId;
  data: Partial<Scenario>;
}

export interface UpdateScenarioResponse {
  scenario: Scenario;
}

export function useScenarioRequests() {
  return {
    all(): Promise<AxiosResponse<ScenarioIndexResponse>> {
      return axiosInstance.get('/scenarios')
    },

    find(id: ScenarioId): Promise<AxiosResponse<ShowScenarioResponse>> {
      return axiosInstance.get(`/scenarios/${id}`)
    },

    daily(): Promise<AxiosResponse<ShowScenarioResponse>> {
      return axiosInstance.get('/scenarios/daily')
    },

    create(payload: StoreScenarioRequest): Promise<AxiosResponse<StoreScenarioResponse>> {
      return axiosInstance.post('/scenarios', {
        scenario_id: payload.scenario_id
      })
    },

    update(payload: UpdateScenarioRequest): Promise<AxiosResponse<StoreScenarioResponse>> {
      return axiosInstance.put(`/scenarios/${payload.scenarioId}`, {
        ...payload.data
      })
    },
  }
}
