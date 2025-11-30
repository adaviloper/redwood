import { beforeEach, describe, expect, it, vi } from 'vitest';
import { usePlayerCharacterRequests, type PlayerCharacterIndexResponse } from '@/composables/usePlayerCharacterRequests';
import axiosInstance from '@/utilities/api';

// Mock the axios instance used by requestFactory
vi.mock('@/utilities/api', () => {
  return {
    default: {
      get: vi.fn(),
    },
  };
});

describe('usePlayerCharacterRequests', () => {
  beforeEach(() => {
    (axiosInstance.get as any).mockReset();
  });

  it('all() returns mocked player characters response', async () => {
    const apiResponse: { data: PlayerCharacterIndexResponse } = {
      data: {
        player_characters: [
          { id: 1, name: 'Alice' },
          { id: 2, name: 'Bob' },
        ],
      },
    };
    (axiosInstance.get as any).mockResolvedValueOnce(apiResponse as any);

    const { all } = usePlayerCharacterRequests();
    const result = await all();

    expect(axiosInstance.get).toHaveBeenCalledWith('/player-characters', {});
    expect(result.data).toEqual(apiResponse.data);
  });

  it('find() returns mocked player character response', async () => {
    const apiResponse = {
      data: {
        character: { id: 1, name: 'Alice' },
      },
    };
    (axiosInstance.get as any).mockResolvedValueOnce(apiResponse as any);

    const { find } = usePlayerCharacterRequests();
    const result = await find(1);

    expect(axiosInstance.get).toHaveBeenCalledWith('/player-characters/1');
    expect(result.data).toEqual(apiResponse.data);
  });
})
