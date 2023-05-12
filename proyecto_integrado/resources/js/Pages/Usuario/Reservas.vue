<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<script>
export default {
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
        <table class="table-auto w-full border">
          <thead class="bg-gray-300">
            <tr>
              <th v-for="column in columns" :key="column.key">{{ column.label }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in pagedData" :key="item.id">
              <td v-for="column in columns" :key="column.key" class="text-center">{{ item[column.key] }}</td>
              <td class="text-center space-x-2">
                <button @click="editItem(item)" class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                <button @click="deleteItem(item)" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
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
    </AuthenticatedLayout>
</template>
        
        <!-- <div class='p-5 grid grid-rows-2 grid-flow-col gap-3'>
            <div class="p-4 items-center w-[600px] rounded-xl sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 items-center w-[600px] rounded-xl sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 items-center w-[600px] rounded-xl  sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 items-center w-[600px] rounded-xl  sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-4 items-center justify-center w-[600px] rounded-xl group sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 items-center justify-center w-[600px] rounded-xl group sm:flex space-x-6 bg-slate-500 bg-opacity-50 shadow-xl">
                <img  class="mx-auto block w-4/12 h-40 rounded-lg"  alt="art cover" loading="lazy" src='../../../assets/foto.png' />
                <div class="sm:w-8/12 pl-0 p-5">
                    <div class="space-y-2">
                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                Título.
                            </h4>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="flex gap-3 space-y-1">
                                <span class="text-sm">⭐⭐⭐⭐</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 justify-between">
                            <div class="text-grey-500 flex flex-row space-x-1  my-4">
                                <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs">Fecha</p>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                    <span>Cancelar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

<style>

</style>