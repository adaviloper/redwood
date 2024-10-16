import { defaultConfig } from '@formkit/vue'
import { createProPlugin, inputs } from '@formkit/pro';
import { rootClasses } from './formkit.theme'

const pro = createProPlugin('fk-5a80b8ce0f2', inputs)

export default defaultConfig({
  config: { rootClasses },
  plugins: [ pro ],
})
