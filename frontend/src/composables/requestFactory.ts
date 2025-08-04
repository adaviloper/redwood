import type { ResourceId } from "@/types/utilities";
import axiosInstance from "@/utilities/api";
import type { AxiosResponse } from "axios";

export function indexRequest<TResponse, TQueryParams = {}>(
  url: string,
  transformParams?: (queryParams: TQueryParams) => any
): (queryParams: TQueryParams) => Promise<AxiosResponse<TResponse>> {
  return (queryParams) => axiosInstance.get(url, {
    params: transformParams ? transformParams(queryParams) : queryParams
  });
};

export function showRequest<T>(url: string): (id: ResourceId) => Promise<AxiosResponse<T>> {
  return (id) => axiosInstance.get(`${url}/${id}`);
};

export function storeRequest<TResponse, TPayload = {}>(
  url: string,
  transform?: (payload: TPayload) => any
): (payload: TPayload) => Promise<AxiosResponse<TResponse>> {
  return (payload) => axiosInstance.post(url, transform ? transform(payload) : payload);
};

export function updateRequest<TResponse, TPayload = {}>(
  url: string,
  transform?: (payload: TPayload) => any
): (id: ResourceId, payload: TPayload) => Promise<AxiosResponse<TResponse>> {
  return (id, payload) => axiosInstance.patch(`${url}/${id}`, transform ? transform(payload) : payload);
};

export function destroyRequest<T>(url: string): (id: ResourceId) => Promise<AxiosResponse<T>> {
  return (id) => axiosInstance.delete(`${url}/${id}`);
};
