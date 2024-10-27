import { type AxiosResponse } from 'axios';
import Cookies from 'js-cookie';
import type { User } from '@/types/User'
import type { Nullable } from '@/types/utilities'
import axiosInstance, { setCSRFToken } from '../utilities/api';
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router';
import { useUserStore } from './user';

const versionString =
  import.meta.env.MODE === 'development' ? import.meta.env.VITE_APP_VERSION + '-dev' : import.meta.env.VITE_APP_VERSION;

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
          const store = useUserStore();
          store.setUser(data)
        })
        .catch(() => {
          router.push('login');
        });
    },
  },

  getters: {
    isReady: (state) => {
      return !state.isInitialized
    },
  },
})
