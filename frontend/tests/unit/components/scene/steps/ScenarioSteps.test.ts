import ScenarioSteps from '@/components/scene/steps/ScenarioSteps.vue';
import type { Step } from '@/types/Scenario';
import { mount } from '@vue/test-utils'
import { describe, expect, test, vi } from 'vitest'

vi.mock('vue-router', () => ({
  useRouter: () => ({ push: vi.fn() }),
}));

describe('Scenario Steps', () => {
  test('Scenario with one step will have multiple options', async () => {
    const steps: Step[] = [
      { // Step 1
        id: 'a',
        copy: 'Step 1 options',
        type: 'option',
        options: [
          {
            reference: 'Option A',
          },
          {
            reference: 'Option B',
          },
        ],
        scenario_step_id: '1',
      },
      { // Step 2
        id: 'a',
        copy: 'Step 1 options',
        type: 'step',
        scenario_step_id: '1',
        action: {
          type: 'roll',
          dice: 'd4',
          ability: 'strength',
        },
      },
    ];

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
      },
    });
    await wrapper.find('.next-step-button').trigger('click');

    expect(wrapper.text()).toContain('Follow these steps:  Next Step');
  });

  test('Steps with a single option are rendered as sequential items', async () => {
    const steps: Step[] = [
      { // Step 1
        id: 'a',
        copy: 'Step 1 options',
        type: 'option',
        options: [
          {
            reference: 'Option A',
          },
          {
            reference: 'Option B',
          },
        ],
        scenario_step_id: '1',
      },
      { // Step 2
        id: 'a',
        copy: 'Step 2 options',
        type: 'step',
        scenario_step_id: '1',
        action: {
          type: 'roll',
          dice: 'd4',
          ability: 'strength',
        },
      },
    ];

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
      },
    });

    expect(wrapper.text()).toContain('Follow these steps:  Next Step');
    await wrapper.find('.next-step-button').trigger('click');

    expect(wrapper.text()).toContain('Follow these steps:  Next Step');
  });
});
