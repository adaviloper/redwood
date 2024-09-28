import type { router } from "@/router";

declare module '@kitbag/router' {
  interface Register {
    router: typeof router
  }
}
