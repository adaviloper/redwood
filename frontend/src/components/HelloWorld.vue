<script setup lang="ts">
const props = defineProps<{
  msg: string
  optionalProp?: number
}>()

defineExpose(props)
</script>

<template>
  <h2 class="!mt-0">
    Welcome
  </h2>

  <p>Kukiloka, ka'ka kinoka'kah agamasha m'm'thnorolg zukago'aganu reroshr zazag noga ukash'g ta'resh. K'ka th'a kashr lahragagog l'as mogomokaagot th'kara nolokazzu zuk'go l'a'i'. Kazr omav'aga reshnagugaz ro'inol gakazi kahres kazin r'kash't mal'k mogol nogosh. Osh'ma kosh mmaa umovarilo' gotage gara. Maz'maznar, khnah mazari gulog'athreg, loro' mazamaz mo'rah ggggog'a aak'aro'bovaz, gok'bo'a gazu, thro'nugg.</p>
</template>
