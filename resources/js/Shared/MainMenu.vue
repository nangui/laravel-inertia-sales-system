<template>
  <div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
        <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('dashboard') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('product-types')">
        <icon name="types" class="w-4 h-4 mr-2" :class="isUrl('product-types') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('product-types') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Types prods</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('products')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('products') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('products') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Produits</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('sales')">
        <icon name="shopping-cart" class="w-4 h-4 mr-2" :class="isUrl('sales') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('sales') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Ventes</div>
      </inertia-link>
    </div>
    <div class="mb-4" v-if="$page.props.auth.user.is_owner">
      <inertia-link class="flex items-center group py-3" :href="route('settings')">
        <icon name="printer" class="w-4 h-4 mr-2" :class="isUrl('settings') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('settings') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Parametres</div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter(url => currentUrl.startsWith(url)).length
    },
  },
}
</script>
