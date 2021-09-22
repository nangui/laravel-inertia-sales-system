<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Tableau de bord</h1>
    <div class="lg:flex space-y-4 lg:space-y-0 lg:space-x-4 mb-4">
      <card title="Types de produits" count="96" link-url="product-types" />
      <card title="Produits" count="1324" link-url="products" />
    </div>
    <div class="lg:flex space-x-4">
      <div class="ld:w-1/2 flex-1 p-4 bg-white rounded">Bar chart</div>
      <div class="ld:w-1/2 flex-1 p-4 bg-white rounded">Doughnut chart</div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Card from '@/Shared/Card'

export default {
  metaInfo: { title: 'Dashboard' },
  components: {
    Card,
  },
  layout: Layout,
  props: {},
  data() {
    return {

    }
  },
}
</script>
