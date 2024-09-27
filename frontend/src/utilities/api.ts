import axios, { type InternalAxiosRequestConfig } from "axios";
import Cookies from 'js-cookie';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

export const redwoodApi = axios.create({
    baseURL: 'http://api.redwood.test/api',
})

export const csrfToken = axios.create({
    baseURL: 'http://api.redwood.test',
    headers: {
        'Content-Type': 'application/json',
    }
})

export const authApi = axios.create({
    baseURL: 'http://api.redwood.test',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
})

// Create axios instance with base url and credentials support
export const axiosInstance = axios.create({
    baseURL: 'http://api.redwood.test',
    withCredentials: true,
    withXSRFToken: true,
});

// Request interceptor. Runs before your request reaches the server
const onRequest = (config: InternalAxiosRequestConfig) => {
    // If http method is `post | put | delete` and XSRF-TOKEN cookie is
    // not present, call '/sanctum/csrf-cookie' to set CSRF token, then
    // proceed with the initial response
                console.log('typescript', config);
    if ((
            config.method == 'post' ||
            config.method == 'put' ||
            config.method == 'delete'
        ) && !Cookies.get('XSRF-TOKEN')) {
        return setCSRFToken()
            .then(response => {
                console.log('typescript', response.data);
                return config;
            });
    }
    return config;
}

// A function that calls '/api/csrf-cookie' to set the CSRF cookies. The
// default is 'sanctum/csrf-cookie' but you can configure it to be anything.
const setCSRFToken = () => {
    return axiosInstance.get('/sanctum/csrf-cookie'); // resolves to '/api/csrf-cookie'.
}

// attach your interceptor
axiosInstance.interceptors.request.use(onRequest, null);

export default axiosInstance;
