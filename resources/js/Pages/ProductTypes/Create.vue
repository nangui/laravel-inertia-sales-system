<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('product-types')">Type de produits</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Créer
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input placeholder="Entrer le libellé" v-model="form.label" :error="form.errors.label" class="pr-6 pb-8 w-full lg:w-1/2" label="Libelle" />
          <select-input v-model="form.product_type_id" :error="form.errors.product_type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Parent">
            <option value="0">Aucun</option>
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.label }}</option>
          </select-input>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Créer le type de produit</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '../../Shared/SelectInput.vue'

export default {
  metaInfo: { title: 'Create Product Type' },
  components: {
    LoadingButton,
    TextareaInput,
    TextInput,
    SelectInput,
  },
  layout: Layout,
  remember: 'form',
  props: ['types'],
  data() {
    return {
      form: this.$inertia.form({
        label: null,
        product_type_id: 0,
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('product-types.store'))
    },
  },
}
</script>
