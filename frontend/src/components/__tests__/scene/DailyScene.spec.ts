import ScenarioSteps from '@/components/scene/ScenarioSteps.vue';
import type { Step } from '@/types/Scenario';
import { mount } from '@vue/test-utils'
import { describe, expect, test } from 'vitest'

describe('Scenario Steps', () => {
  test('Scenario with one step will have multiple options', async () => {
    const steps: Step[] = [
      {
        options: [
          {
            copy: 'Option 1',
          },
          {
            copy: 'Option 2',
          },
        ],
      },
    ];

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
      },
    });

    expect(wrapper.text()).toContain('1: Option 1');
    expect(wrapper.text()).toContain('2: Option 2');
  });

  test('Steps with a single option are rendered as sequential items', async () => {
    const steps: Step[] = [
      {
        options: [
          {
            copy: 'Step 1',
          },
        ],
      },
      {
        options: [
          {
            copy: 'Option 2.1',
          },
          {
            copy: 'Option 2.2',
          },
        ],
      }
    ];

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
      },
    });

    expect(wrapper.text()).toContain('1: Step 1');
    expect(wrapper.text()).toContain('2.1: Option 2.1');
    expect(wrapper.text()).toContain('2.2: Option 2.2');
  });
});
