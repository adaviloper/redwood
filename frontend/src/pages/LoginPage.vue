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
import axiosInstance from '@/utilities/api';
import { FormKit } from '@formkit/vue';
import { type AxiosResponse } from 'axios';
import { useRouter } from '@kitbag/router';

interface LoginPayload {
    username: string;
    email: string;
}

const router = useRouter();

const login = async (payload: LoginPayload) => {
  axiosInstance.post('auth/login', {
    ...payload,
  })
    .then((response: AxiosResponse) => {
      console.log('LoginPage.vue:40', response);
      router.push('root')
    });
};

</script>

<style scoped>

</style>
