<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Parametres ({{ settings.data.length }} éléments)</h1>
    <div class="mb-6 flex justify-end items-center">
      <inertia-link :href="route('settings.create')" class="btn-indigo">
        <span>Ajouter</span>
        <span class="hidden md:inline">un parametre</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Constante</th>
          <th class="px-6 pt-6 pb-4">Valeur</th>
        </tr>
        <tr v-for="setting in settingsData" :key="setting.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link :href="route('settings.edit', setting.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ setting.name }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('settings.edit', setting.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ setting.value }}
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link :href="route('settings.edit', setting.id)" class="px-4 flex items-center" tabindex="-1">
              <icon class="block w-6 h-6 fill-gray-400" name="cheveron-right" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="settingsData.length === 0">
          <td class="border-t px-6 py-4" colspan="4">Aucun parametre trouvé.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import Pagination from '@/Shared/Pagination'

export default {
  metaInfo: { title: 'Settings' },
  components: {
    Icon,
    Pagination,
  },
  layout: Layout,
  props: {
    settings: {
      type: Object,
      default: () => ({})
    }
  },
  data() {
    console.log(this.settings.data)
    return {

    }
  },
  computed: {
    settingsData() {
      return this.settings.data
    },
  },
}
</script>
