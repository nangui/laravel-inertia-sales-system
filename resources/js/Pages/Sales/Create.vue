<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('sales')">Opération de Caisse</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Ajout
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.amount" :error="form.errors.amount" type="number" class="pr-6 pb-8 w-full lg:w-1/2" label="Montant" />
          <text-input v-model="form.date" type="date" :error="form.errors.date" class="pr-6 pb-8 w-full lg:w-1/2" label="Date" />
          <select-input v-model="form.type" :error="form.errors.type" class="pr-6 pb-8 w-full lg:w-1/2" label="Type">
            <option :value="null" />
            <option value="sale">Vente</option>
            <option value="transaction">Transaction</option>
          </select-input>
          <textarea-input v-model="form.observation" :error="form.errors.observation" class="pr-6 pb-8 w-full" label="Observation" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Enregistrer l'opération</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout.vue'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TextareaInput from '@/Shared/TextareaInput'

export default {
  metaInfo: { title: 'Create Sale' },
  components: {
    TextareaInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        amount: null,
        date: null,
        type: null,
        observation: null,
        user_id: this.$inertia.page.props.auth.user.id,
      })
    }
  },
  methods: {
    store() {
      this.form.post(this.route('sales.store'))
    }
  },
}
</script>
