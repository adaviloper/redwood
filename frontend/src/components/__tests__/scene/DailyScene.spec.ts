import ScenarioSteps from '@/components/scene/ScenarioSteps.vue';
import type { InstructionList } from '@/types/Scenario';
import { mount } from '@vue/test-utils'
import { describe, expect, test } from 'vitest'

describe('Scenario Steps', () => {
  test('Scenario with one step will have multiple options', async () => {
    const steps: InstructionList = {
      aa: { // Step 1
        label: 'Step 1',
        copy: 'Step 1 options',
        options: [
          {
            copy: 'Option A',
          },
          {
            copy: 'Option B',
            next: 'bb',
          },
        ],
        next: 'dd',
      },
      bb: {
        label: 'Option B steps',
        copy: 'Some copy',
        options: [
          {
            copy: 'Option 1.B.1',
            next: 'cc',
          },
          {
            copy: 'Option 1.B.2',
          },
        ],
      },
      cc: {
        label: 'Steps 1.B.1',
        copy: 'Copylkjsdf',
        options: [
          {
            copy: 'Option 1.B.1.1',
          },
          {
            copy: 'Option 1.B.1.2',
          }
        ],
      },
      dd: {
        label: 'Step 2',
        copy: 'Copylkjsdf',
      },
    };

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
        startingStep: 'bb',
      },
    });
    await wrapper.find('.select-options-bb').trigger('click');

    expect(wrapper.text()).toContain('Option 1.B.1');
    expect(wrapper.text()).toContain('Option 1.B.2');
  });

  test('Steps with a single option are rendered as sequential items', async () => {
    const steps: InstructionList = {
      aa: { // Step 1
        label: 'Step 1',
        copy: 'Step 1 options',
        options: [
          {
            copy: 'Option A',
          },
          {
            copy: 'Option B',
            next: 'bb',
          },
        ],
        next: 'dd',
      },
      bb: {
        label: 'Option B steps',
        copy: 'Some copy',
        options: [
          {
            copy: 'Option 1.B.1',
            next: 'cc',
          },
          {
            copy: 'Option 1.B.2',
          },
        ],
      },
      cc: {
        label: 'Steps 1.B.1',
        copy: 'Copylkjsdf',
        options: [
          {
            copy: 'Option 1.B.1.1',
          },
          {
            copy: 'Option 1.B.1.2',
          }
        ],
      },
      dd: {
        label: 'Step 2',
        copy: 'Copylkjsdf',
      },
    };

    const wrapper = mount(ScenarioSteps, {
      props: {
        steps,
        startingStep: 'aa',
      },
    });

    expect(wrapper.text()).toContain('Step 1');
    await wrapper.find('.select-options-aa').trigger('click');

    expect(wrapper.text()).toContain('Option A');
    expect(wrapper.text()).toContain('Option B');
  });
});
