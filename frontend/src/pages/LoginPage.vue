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
import { type AxiosResponse } from 'axios';
import { useRouter } from '@kitbag/router';
import { useMainStore } from '@/store';
import type { User } from '@/types/User';

interface LoginRequest {
    username: string;
    email: string;
}

interface LoginResponse {
  user: User
}

const store = useMainStore();
const router = useRouter();

const login = (payload: LoginRequest) => {
  store.login(payload)
    .then((_: AxiosResponse<LoginResponse>) => {
      router.push('home')
    });
};
</script>

<style scoped>

</style>
