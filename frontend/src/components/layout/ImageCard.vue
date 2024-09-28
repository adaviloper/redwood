<script setup lang="ts">
interface Props {
  imageUrl: string;
  altText?: string;
}

defineProps<Props>();
</script>

<template>
  <div
class="card-component my-4 max-w-2xl overflow-hidden bg-white rounded-lg">
    <img
      v-if="imageUrl"
      class="object-cover w-full h-64"
      :src="imageUrl" :alt="altText"
    />

    <div class="p-6">
      <slot></slot>
    </div>
  </div>
</template>

<style lang="postcss">
.card-component {
  @apply my-4
}
</style>
