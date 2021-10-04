<template>
  <div></div>
</template>

<script>import Layout from "@/Shared/Layout.vue"

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  components: {},
  layout: Layout,
  props: {
    setting: Object,
  },
  remember: 'form',
  data() {
    return {
      form: {
        name: this.setting.name,
        value: this.setting.value,
      },
    };
  },
  methods: {
    update() {
      this.form.put(this.route('settings.update', this.setting.id))
    },
    destroy() {
      if (confirm('Etes-vous sure de vouloir supprimer ce parametre?')) {
        this.$inertia.delete(this.route('settings.destroy', this.setting.id))
      }
    },
  },
}
</script>
