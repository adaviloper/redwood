<script setup lang="ts">
interface Props {
  imageUrl: string;
  altText?: string;
}

defineProps<Props>();
</script>

<template>
  <div
    class="mb-4 overflow-hidden bg-white rounded-lg">
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
</style>
