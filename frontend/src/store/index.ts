import { type AxiosResponse } from 'axios';
import Cookies from 'js-cookie';
import type { User } from '@/types/User'
import type { Nullable } from '@/types/utilities'
import axiosInstance, { setCSRFToken } from '../utilities/api';
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router';

const versionString =
  import.meta.env.MODE === 'development' ? import.meta.env.VITE_APP_VERSION + '-dev' : import.meta.env.VITE_APP_VERSION;

interface LoginRequest {
    username: string;
    email: string;
}

interface LoginResponse {
    user: User;
}

interface State {
  debug: boolean;
  version: string;
  isInitialized: boolean;
  count: number;
  user: Nullable<User>;
}

export const useMainStore = defineStore('main', {
  state: (): State => ({
    debug: import.meta.env.MODE === 'development',
    version: versionString,
    isInitialized: false,
    count: 0,
    user: null,
  }),

  actions: {
    async initApp() {
      await this.authenticate();

      this.isInitialized = true
      return true;
    },

    async authenticate() {
      const router = useRouter();

      if (!Cookies.get('XSRF-TOKEN')) {
        setCSRFToken();
      }

      await axiosInstance.get('/user')
        .then(({ data }: AxiosResponse<User>) => {
          this.setUser(data)
        })
        .catch(_ => {
          router.push('login');
        });
    },

    async login(payload: LoginRequest) {
      const { data }: AxiosResponse<LoginResponse> = await axiosInstance.post('auth/login', {
        ...payload,
      });
      this.setUser(data.user)
      return this.user;
    },

    async logout() {
      await axiosInstance.post('auth/logout');
      this.setUser(null);
    },

    setUser(user: Nullable<User>) {
      this.user = user;
    },

    increment(value = 1) {
      this.count += value
    },

    goToDemo(event: Event) {
      event.preventDefault()
      this.router.push('/demo/')
    },
  },

  getters: {
    isReady: (state) => {
      return !state.isInitialized
    },

    isGuest: (state) => {
      return state.user === null;
    },

    isAuthenticated: (state) => {
      return state.user !== null;
    },
  },
})
