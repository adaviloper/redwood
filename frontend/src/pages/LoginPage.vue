<script setup lang="ts">
import { FormKit } from '@formkit/vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/store/user';

interface LoginRequest {
    username: string;
    email: string;
}

const store = useUserStore();
const router = useRouter();

const login = async (payload: LoginRequest) => {
  await store.login(payload);

  if (store.isAuthenticated) {
    router.push({ name: 'character-select' });
  }
};
</script>

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

<style scoped>

</style>
