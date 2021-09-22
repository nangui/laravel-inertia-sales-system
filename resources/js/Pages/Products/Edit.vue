<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('products')">Produits</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="product.deleted_at" class="mb-6" @restore="restore">
      Ce produit avait été supprimé.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.label" :error="form.errors.label" class="pr-6 pb-8 w-full lg:w-1/2" label="Libellé" />
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nom" />
          <select-input v-model="form.product_type_id" :error="form.errors.product_type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Type">
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.label }}</option>
          </select-input>
          <text-input v-model="form.unit_price" type="number" :error="form.errors.unit_price" class="pr-6 pb-8 w-full lg:w-1/2" label="Prix Unitaire" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full" label="Description" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!product.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Supprimer</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Mettre à jour</loading-button>
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
import TrashedMessage from '@/Shared/TrashedMessage'
import TextareaInput from '../../Shared/TextareaInput'

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  components: {
    TextareaInput,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    product: Object,
    types: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        label: this.product.label,
        name: this.product.name,
        product_type_id: this.product.product_type_id,
        unit_price: this.product.unit_price,
        description: this.product.description,
        user_id: this.$inertia.page.props.auth.user.id,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('products.update', this.product.id))
    },
    destroy() {
      if (confirm('Etes-vous sure de vouloir supprimer ce produit?')) {
        this.$inertia.delete(this.route('products.destroy', this.product.id))
      }
    },
    restore() {
      if (confirm('Etes-vous sure de vouloir restauré ce produit?')) {
        this.$inertia.put(this.route('products.restore', this.product.id))
      }
    },
  },
}
</script>
