<template>
  <div class="p-4 mx-auto prose md:px-6 prose-indigo sm:rounded-md">
    <FormKit
      type="form"
      @submit="login"
    >
      <FormKit
        type="text"
        name="username"
        label="Username"
        validation="required"
      />
      <FormKit
        type="password"
        name="password"
        label="Password"
        validation="required"
      />
    </FormKit>
  </div>
</template>

<script setup lang="ts">
import { FormKit } from '@formkit/vue';
import { useRouter } from 'vue-router';
import { useMainStore } from '@/store';

interface LoginRequest {
    username: string;
    email: string;
}

const store = useMainStore();
const router = useRouter();

const login = async (payload: LoginRequest) => {
  await store.login(payload);

  if (store.isAuthenticated) {
    router.push({ name: 'character-select' });
  }
};
</script>

<style scoped>

</style>
