<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('settings')">Parametres</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Créer
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nom" />
          <text-input v-model="form.value" :error="form.errors.value" class="pr-6 pb-8 w-full lg:w-1/2" label="Valeur" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Créer le parametre</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
export default {
  metaInfo: { title: 'Create Setting' },
  components: {
    TextInput,
    LoadingButton,
  },
  layout: Layout,
  remember: 'form',
  data () {
    return {
      form: this.$inertia.form({
        name: null,
        value: null,
      })
    }
  },
  methods: {
    store() {
      this.form.post(this.route('settings.store'))
    },
  },
}
</script>