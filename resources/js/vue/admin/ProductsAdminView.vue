<template>
     <div class="flex flex-col">
         <ul class="flex flex-row m-5 lg:text-2xl justify-end">
            <label class="btn modal-button">Añadir Producto</label>
         </ul>
         <div class="my-2 overflow-x-auto lg:mx-2 max-w-screen">
             <div class="overflow-x-auto w-full text-gray-900">
                 <table class="table w-full">
                     <thead>
                     <tr>
                         <th class="bg-gray-200">Id</th>
                         <th class="bg-gray-200 text-center">Name</th>
                         <th class="bg-gray-200 text-center">Description</th>
                         <th class="bg-gray-200 text-center">Stock</th>
                         <th class="bg-gray-200 text-center">Price</th>
                         <th class="bg-gray-200 text-center">status</th>
                         <th class="bg-gray-200 text-center">category id</th>
                         <th class="bg-gray-200 text-center">Fecha de Creación</th>
                         <th class="bg-gray-200 text-center">Fecha de Actualización</th>
                         <th class="bg-gray-200"></th>
                     </tr>
                     </thead>
                     <tbody>
                         <tr v-for="product in products" :key="product.id">
                             <td class="bg-white text-center font-bold h-full w-12">
                            <label class="text-lg">
                              {{ product.id }}
                            </label>
                          </td>
                             <td class="text-center">{{ product.name }}</td>
                             <td class="text-center">{{ product.description }}</td>
                             <td class="text-center">{{ product.stock }}</td>
                             <td class="text-center">{{ product.price }}</td>
                             <td class="text-center" v-if="!product.status">   </td>
                             <td class="text-center" v-if="product.status">{{ product.status }}</td>
                             <td class="text-center">{{ product.category_id }}</td>
                             <td class="text-center">{{ product.created_at }}</td>
                             <td class="text-center">{{ product.updated_at }}</td>
                             <td>
                                 <button class="btn bg-red-500" @click="show(product)"> Delete </button>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
         <DeleteModal/>
    </div>
</template>

<script>
    import axios from "axios";
    import Modal from "../../components/Modal";
    import DeleteModal from "../../components/DeleteModal";

    let products;
    let updateProducts;
    let getProducts;
    let deleteProduct;
    let getChart;


    export default {
        name: "ProductsAdminView",
        components: {
            DeleteModal,
            Modal,
        },

        data() {
            return {
                products: []
            };
        },
        methods: {
            updateProducts(newData) {
                this.products = newData
            },
            show(product) {
                this.$root.$emit('open-modal', product);
            },
            getProducts() {
                axios
                    .get('/api/productsapi').then(response => {
                    let data = Object.values(response.data.data);
                    console.log(data)
                    this.updateProducts(data)

                })
            },
            deleteProduct(product_id) {
                console.log('eliminar')
            },
        },

        mounted() {
            this.getProducts()
            this.$root.$on("deleteProducts", (data) => {
                console.log('SE DEBE ELIMINAR')
                this.deleteProduct()
            });

    }}
</script>
