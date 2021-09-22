<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('products')">Produits</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Créer
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.label" :error="form.errors.label" class="pr-6 pb-8 w-full lg:w-1/2" label="Libellé" />
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
          <select-input v-model="form.product_type_id" :error="form.errors.product_type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Type">
            <option :value="null" />
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.label }}</option>
          </select-input>
          <text-input v-model="form.unit_price" :error="form.errors.unit_price" type="number" class="pr-6 pb-8 w-full lg:w-1/2" label="Prix unitaire" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full" label="Designation" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Créer le produit</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TextareaInput from '../../Shared/TextareaInput'

export default {
  metaInfo: { title: 'Create Product' },
  components: {
    TextareaInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    types: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        label: null,
        name: null,
        description: null,
        product_type_id: null,
        unit_price: null,
        user_id: this.$inertia.page.props.auth.user.id,
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('products.store'))
    },
  },
}
</script>
