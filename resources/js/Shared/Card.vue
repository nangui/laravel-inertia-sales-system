<template>
  <div class="flex-1 p-4 relative rounded shadow-sm bg-white">
    <h2 class="font-normal mb-2.5">{{ title }}</h2>
    <p class="leading-normal text-3xl text-indigo-500 hover:text-yellow-600 font-black">
      <VueJsCounter :end="count" />
    </p>
    <small class="block text-xs">Total</small>
    <div class="flex mt-8 space-x-4">
      <div class="flex-1 bg-yellow-400 rounded p-2">
        <p class="text-white font-black mb-1">11</p>
        <inertia-link class="flex justify-between cursor-pointer" :href="route(linkUrl)">
          <small class="block text-xs text-gray-600">Active(s)</small>
          <icon name="arrow-right" />
        </inertia-link>
      </div>
      <div class="flex-1 bg-indigo-400 rounded p-2">
        <p class="text-white font-black mb-1">11</p>
        <inertia-link class="flex justify-between cursor-pointer" :href="onlyTrashed()">
          <small class="block text-xs text-gray-600">Archive(s)</small>
          <icon name="arrow-right" />
        </inertia-link>
      </div>
      <div class="flex-1 bg-green-400 rounded p-2">
        <p class="text-white font-black mb-1">11</p>
        <inertia-link class="flex justify-between" :href="withTrashed()">
          <small class="block text-xs text-gray-600">Tout</small>
          <icon name="arrow-right" />
        </inertia-link>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import VueJsCounter from 'vue-js-counter'


export default {
  components: {
    Icon,
    VueJsCounter,
  },
  inheritAttrs: false,
  props: {
    id: String,
    title: String,
    count: String,
    linkUrl: String,
  },
  methods: {
    onlyTrashed: function () {
      return '/' + this.linkUrl + '?trashed=only'
    },
    withTrashed: function () {
      return '/' + this.linkUrl + '?trashed=with'
    },
  },
}
</script>
