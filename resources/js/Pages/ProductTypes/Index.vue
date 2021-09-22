<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Type de produits <small class="text-gray-500">({{ types.total }} éléments)</small></h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
        <label class="block text-gray-700">Mis en corbeille:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">Avec mis en corbeille</option>
          <option value="only">Seulement mis en corbeille</option>
        </select>
      </search-filter>
      <inertia-link :href="route('product-types.create')" class="btn-indigo">
        <span>Ajouter</span>
        <span class="hidden md:inline">un type de produit</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Code</th>
          <th class="px-6 pt-6 pb-4">Parent</th>
        </tr>
        <tr v-for="type in types.data" :key="type.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link :href="route('product-types.edit', type.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ type.label }}
              <icon v-if="type.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('product-types.edit', type.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ type.parent }}
              <icon v-if="type.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link :href="route('product-types.edit', type.id)" class="px-4 flex items-center" tabindex="-1">
              <icon class="block w-6 h-6 fill-gray-400" name="cheveron-right" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="types.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">Aucun type de produit trouvé.</td>
        </tr>
      </table>
    </div>
    <pagination :links="types.links" class="mt-6" />
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  metaInfo: { title: 'Product Types' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    types: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function() {
        this.$inertia.get(this.route('product-types'), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
