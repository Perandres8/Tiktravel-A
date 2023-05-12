<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
</script>
<script>
export default {
  components: { DangerButton },
  data() {
    return {
      searchText: '',
      perPage: 5,
      currentPage: 1,
      columns: [
        { key: 'id', label: 'ID' },
        { key: 'name', label: 'Nombre' },
        { key: 'email', label: 'Email' },
        { key: 'password', label: 'Contaseña' },
        // Agrega más columnas según tu estructura de datos
      ],
      data: [
        {id:1, name: "Álvaro", email: "alvaroperandres10@gmail.com", password: "11111111"},
        {id:2, name: "Jaime", email: "jaime@gmail.com", password: "11111111"},
        {id:1, name: "Álvaro", email: "alvaroperandres10@gmail.com", password: "11111111"},
        {id:2, name: "Jaime", email: "jaime@gmail.com", password: "11111111"},
        {id:1, name: "Álvaro", email: "alvaroperandres10@gmail.com", password: "11111111"},
        {id:2, name: "Jaime", email: "jaime@gmail.com", password: "11111111"},
      ], // Aquí se almacenarán los datos obtenidos de la base de datos
    };
  },
  computed: {
    filteredData() {
      return this.data.filter(item => {
        // Filtrar por la columna 'name' y 'email'. Puedes ajustar los campos según tu estructura de datos
        return (
          item.name.toLowerCase().includes(this.searchText.toLowerCase()) ||
          item.email.toLowerCase().includes(this.searchText.toLowerCase())
        );
      });
    },
    pagedData() {
      const startIndex = (this.currentPage - 1) * this.perPage;
      const endIndex = startIndex + this.perPage;
      return this.filteredData.slice(startIndex, endIndex);
    },
    firstIndex() {
      return (this.currentPage - 1) * this.perPage + 1;
    },
    lastIndex() {
  return Math.min(this.currentPage * this.perPage, this.filteredData.length);
},
pageCount() {
  return Math.ceil(this.filteredData.length / this.perPage);
},
perPageOptions() {
  return [5,10,20]; // Opciones para seleccionar resultados por página
},
},
methods: {
    editItem(item) {
      // Implementa la lógica para editar el elemento
      console.log("Editar:", item);
    },
    deleteItem(item) {
      // Implementa la lógica para eliminar el elemento
      console.log("Eliminar:", item);
      if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
      const index = this.data.findIndex((element) => element.id === item.id);
      if (index !== -1) {
        this.data.splice(index, 1);
        console.log("Elemento eliminado:", item);
      }
    }
    },
    addItem() {
      // Implementa la lógica para agregar un nuevo elemento
      // Puedes mostrar un formulario o utilizar una ventana modal
      console.log("Añadir nuevo elemento");
},
  },
mounted() {
  // Aquí puedes realizar la conexión con la base de datos y obtener los datos
  // Por ejemplo, utilizando axios para hacer una solicitud HTTP
  axios.get('/api/data').then(response => {
    this.data = response.data;
  }).catch(error => {
    console.error(error);
  });
},
};
</script>

<template>
    <AuthenticatedLayout>
      <div class=" bg-gray-400/80">
        <div class="container mx-auto py-4">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
              <label for="search" class="mr-2">Buscar:</label>
              <input type="text" id="search" v-model="searchText" class="py-1 px-2 border rounded-md">
            </div>
            <div>
              <label for="perPage" class="mr-2">Resultados por página:</label>
              <select id="perPage" v-model="perPage" class="py-1 px-6 border rounded-md">
                <option v-for="option in perPageOptions" :key="option" :value="option">{{ option }}</option>
              </select>
            </div>
          </div>
          <table class="table-auto w-full border border-gray-500">
            <thead class="bg-gray-300">
              <tr>
                <th v-for="column in columns" :key="column.key">{{ column.label }}</th>
                <th>Editar/Eliminar/Añadir</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr v-for="item in pagedData" :key="item.id">
                <td v-for="column in columns" :key="column.key" class="text-center">{{ item[column.key] }}</td>
                <td class="text-center space-x-2">
                  <button @click="editItem(item)" class="px-2 py-1 bg-blue-500 text-white rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></button>
                  <button @click="deleteItem(item)" class="px-2 py-1 bg-red-500 text-white rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                  </svg></button>
                  <button @click="addItem" class="px-2 py-1 bg-green-500 text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex justify-between items-center mt-4">
            <div>
              <p class="text-sm text-gray-600">
                Mostrando {{ firstIndex }} - {{ lastIndex }} de {{ filteredData.length }} resultados.
              </p>
            </div>
            <div>
              <button
                :disabled="currentPage === 1"
                @click="currentPage -= 1"
                class="py-1 px-4 bg-gray-200 rounded-md mr-2"
              >
                Anterior
              </button>
              <button
                :disabled="currentPage === pageCount"
                @click="currentPage += 1"
                class="py-1 px-4 bg-gray-200 rounded-md"
              >
                Siguiente
              </button>
            </div>
          </div>
        </div>

        <hr>
  
      </div>
    </AuthenticatedLayout>
</template>

<style>

</style>