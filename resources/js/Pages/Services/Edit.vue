<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('services')">Services</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.description }}
    </h1>
    <trashed-message v-if="service.deleted_at" class="mb-6" @restore="restore">
      Ce service a été supprimé.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.code" :error="form.errors.code" class="pr-6 pb-8 w-full lg:w-1/2" label="Code" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Description" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!service.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Supprimer</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Mettre à jour</loading-button>
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
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  metaInfo() {
    return {
      title: `${this.form.code} - ${this.form.description}`,
    }
  },
  components: {
    LoadingButton,
    TextareaInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    service: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        code: this.service.code,
        description: this.service.description,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('services.update', this.service.id))
    },
    destroy() {
      if (confirm('Veux tu supprimer ce service?')) {
        this.$inertia.delete(this.route('services.destroy', this.service.id))
      }
    },
    restore() {
      if (confirm('Etes vous sure de vouloir restorer ce service?')) {
        this.$inertia.put(this.route('services.restore', this.service.id))
      }
    },
  },
}
</script>
