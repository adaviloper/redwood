/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,

  extends: [
    'plugin:vue/vue3-recommended',
    'eslint:recommended',
    '@vue/eslint-config-typescript',
    '@vue/eslint-config-prettier/skip-formatting',
    'plugin:security/recommended-legacy',
    './.eslintrc-auto-import.json',
  ],

  overrides: [
    {
      files: ['tests/e2e/**/*.{test,spec}.{js,ts,jsx,tsx}'],
      extends: ['plugin:playwright/recommended'],
    },
  ],

  parserOptions: {
    ecmaVersion: 'latest',
  },

  plugins: [
    'eslint-plugin-unused-imports',
  ],

  rules: {
    'no-var': 'error',
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',

    'comma-dangle': ['error', 'only-multiline'],
    'id-length': [2, { exceptions: ['i', 'j', 'x', 'y', '_'] }],
    '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '_' }],
    'vue/block-order': ['error', {
      'order': [ 'script', 'template', 'style' ],
    }],

    "no-unused-vars": "off", // or "@typescript-eslint/no-unused-vars": "off",
    "unused-imports/no-unused-imports": "error",
    "unused-imports/no-unused-vars": [
      "warn",
      {
        "vars": "all",
        "varsIgnorePattern": "^_",
        "args": "after-used",
        "argsIgnorePattern": "^_",
      },
    ],
    "vue/no-unused-vars": ["error", {
      "ignorePattern": "^_",
    }],

    "vue/padding-line-between-tags": ["error", [
      {
        "blankLine": "always",
        "prev": "*",
        "next": "*",
      }
    ]],
  },

  globals: {
    defineProps: 'readonly',
    defineEmits: 'readonly',
    defineExpose: 'readonly',
    withDefaults: 'readonly',
  },

  ignorePatterns: [
    'tests/e2e/**/*.ts',
    'formkit.theme.ts'
  ],
}
