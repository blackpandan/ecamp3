<template>
  <v-btn
    class="px-3 px-sm-4"
    min-width="0"
    :color="color"
    v-bind="$attrs"
    v-on="$listeners">
    <v-icon :left="$vuetify.breakpoint.smAndUp" size="150%">{{ icon }}</v-icon>
    <span class="d-none d-sm-block">
      <slot>{{ $tc('global.button.add') }}</slot>
    </span>
  </v-btn>
</template>

<script>
export default {
  name: 'ButtonAdd',
  props: {
    icon: { type: String, default: 'mdi-plus' },
    color: { type: String, default: 'success' }
  }
}
</script>

<style scoped>
</style>
