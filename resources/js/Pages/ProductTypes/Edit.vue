<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('product-types')">Type de produits</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.label }}
    </h1>
    <trashed-message v-if="type.deleted_at" class="mb-6" @restore="restore">
      Ce type a été supprimé.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.label" :error="form.errors.label" class="pr-6 pb-8 w-full lg:w-1/2" label="Label" />
          <select-input v-model="form.product_type_id" :error="form.errors.product_type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Parent">
            <option v-for="t in types" :key="t.id" :value="t.id">{{ t.label }}</option>
          </select-input>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!type.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Supprimer</button>
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

export default {
  metaInfo() {
    return {
      title: `${this.form.label}`,
    }
  },
  components: {
    LoadingButton,
    TextInput,
    SelectInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    type: Object,
    types: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        label: this.type.label,
        product_type_id: this.type.parent.id,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('product-types.update', this.type.id))
    },
    destroy() {
      if (confirm('Veux tu supprimer ce type?')) {
        this.$inertia.delete(this.route('product-types.destroy', this.type.id))
      }
    },
    restore() {
      if (confirm('Etes vous sure de vouloir restorer ce type?')) {
        this.$inertia.put(this.route('product-types.restore', this.type.id))
      }
    },
  },
}
</script>
