<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Opération de caisse ({{ sales.data.length }} éléments)</h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
        <label class="block text-gray-700">Mis en corbeille:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">Avec mis en corbeille</option>
          <option value="only">Seulement mis en corbeille</option>
        </select>
      </search-filter>
      <inertia-link :href="route('sales.create')" class="btn-indigo">
        <span>Enregistrer</span>
        <span class="hidden md:inline">une vente</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">#ID</th>
          <th class="px-6 pt-6 pb-4">Montant</th>
          <th class="px-6 pt-6 pb-4">Date</th>
          <th class="px-6 pt-6 pb-4">Action</th>
          <th class="px-6 pt-6 pb-4">Utilisateur</th>
        </tr>
        <tr v-for="sale in sales.data" :key="sale.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ sale.id }}
              <icon v-if="sale.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ sale.amount }}
              <icon v-if="sale.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ sale.date }}
              <icon v-if="sale.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ sale.type === 'sale' ? 'Vente' : 'Transaction' }}
              <icon v-if="sale.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-6 py-4 flex items-center focus:text-indigo-500">
              {{ sale.user.first_name }} {{ sale.user.last_name }}
              <icon v-if="sale.deleted_at" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" name="trash" />
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link :href="route('sales.edit', sale.id)" class="px-4 flex items-center" tabindex="-1">
              <icon class="block w-6 h-6 fill-gray-400" name="cheveron-right" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="sales.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">Aucun produit trouvé.</td>
        </tr>
      </table>
    </div>
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
  metaInfo: { title: 'Sales' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    sales: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      }
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(this.route('sales'), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    }
  }
}
</script>
