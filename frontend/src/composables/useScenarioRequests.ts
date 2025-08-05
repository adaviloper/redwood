import type { Scenario, ScenarioId } from "@/types/Scenario";
import { indexRequest, showRequest, storeRequest, updateRequest } from "./requestFactory";

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
    all: indexRequest<ScenarioIndexResponse>('/scenarios'),

    find: showRequest<ShowScenarioResponse>(`/scenarios`),

    create: storeRequest<StoreScenarioResponse, StoreScenarioRequest>('/scenarios'),

    update: updateRequest<StoreScenarioResponse, UpdateScenarioRequest>(`/scenarios`, (payload: UpdateScenarioRequest) => ({
        ...payload.data
      })
    ),
  }
}
