<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>

    <div v-if="productos.length === 0">No hay productos aún.</div>

    <ul v-else>
      <li
        v-for="producto in productos"
        :key="producto.id"
        class="border p-4 mb-2 rounded"
      >
        <strong>{{ producto.nombre }}</strong><br>
        <small>Creado por: {{ producto.user?.name ?? 'N/A' }}</small>
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({
  productos: Array
})
</script>





