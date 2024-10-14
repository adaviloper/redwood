import { type AxiosResponse } from 'axios';
import type { User } from '@/types/User'
import type { Nullable } from '@/types/utilities'
import axiosInstance from '@/utilities/api';
import { defineStore } from 'pinia'

interface LoginRequest {
    username: string;
    email: string;
}

interface LoginResponse {
    user: User;
}

interface State {
  user: Nullable<User>;
}

export const useUserStore = defineStore('user', {
  state: (): State => ({
    user: null,
  }),

  actions: {
    setUser(user: Nullable<User>) {
      this.user = user;
    },

    async login(payload: LoginRequest) {
      const { data }: AxiosResponse<LoginResponse> = await axiosInstance.post('auth/login', {
        ...payload,
      });
      const store = useUserStore();
      store.setUser(data.user)
      return this.user;
    },

    async logout() {
      await axiosInstance.post('auth/logout');
      const store = useUserStore();
      store.setUser(null);
    },

  },

  getters: {
    isGuest: (state) => {
      return state.user === null;
    },

    isAuthenticated: (state) => {
      return state.user !== null;
    },

    hasPermission: (state) => {
      return (permissionName: string) => {
        state.user
          ?.all_permissions
          .find(permission => permission.name === permissionName)
      }
    },
  },
})
