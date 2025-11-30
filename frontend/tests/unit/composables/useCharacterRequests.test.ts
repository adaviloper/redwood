import { beforeEach, describe, expect, it, vi } from 'vitest';
import { useCharacterRequests } from '@/composables/useCharacterRequests';
import axiosInstance from '@/utilities/api';

// Mock the axios instance used by requestFactory
vi.mock('@/utilities/api', () => {
  return {
    default: {
      get: vi.fn(),
    },
  };
});

describe('useCharacterRequests', () => {
  beforeEach(() => {
    (axiosInstance.get as any).mockReset();
  });

  it('all() returns mocked characters response', async () => {
    const apiResponse = {
      data: {
        characters: [
          { id: 1, name: 'Alice' },
          { id: 2, name: 'Bob' },
        ],
      },
    };
    (axiosInstance.get as any).mockResolvedValueOnce(apiResponse as any);

    const { all } = useCharacterRequests();
    const result = await all();

    expect(axiosInstance.get).toHaveBeenCalledWith('/characters', {});
    expect(result.data).toEqual(apiResponse.data);
  });

  it('find() returns mocked character response', async () => {
    const apiResponse = {
      data: {
        character: { id: 1, name: 'Alice' },
      },
    };
    (axiosInstance.get as any).mockResolvedValueOnce(apiResponse as any);

    const { find } = useCharacterRequests();
    const result = await find(1);

    expect(axiosInstance.get).toHaveBeenCalledWith('/characters/1');
    expect(result.data).toEqual(apiResponse.data);
  });
})
