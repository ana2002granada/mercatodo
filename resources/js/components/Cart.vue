<template>
    <div>
        <span class="relative inline-flex">
            <button
                @click="isOpen = !isOpen"
                class="bg-gray-200 hover:bg-gray-300 rounded-full p-2 flex items-center text-gray-600 focus:outline-none"
            >
                <em class="fas fa-cart-plus"></em>
            </button>
            <span
                class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1"
                v-if="items.length">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-700 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-400"></span>
            </span>
        </span>
        <div
            :class="
                isOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'
            "
            class="pb-44 overflow-auto z-50 fixed right-0 top-0 max-w-xs w-full px-6 py-4 transition duration-300 transform mt-28 overflow-y-auto bg-white flex flex-col flex-grow h-full fixed"
        >
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700">Carro de compras</h3>
                <button
                    @click="isOpen = !isOpen"
                    class="text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <hr class="my-3" />
            <ItemCart
                @item-change="updateItem"
                v-for="item in items"
                :key="item.id"
                :item="item"
            />
            <span class="text-xl font-bold py-2">{{'Total '+getTotal }}</span>
            <button
                @click="processPayment"
                class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500" >
                <span>Pagar</span>
            </button>
        </div>
    </div>
</template>

<script>
import ItemCart from "./ItemCart";
import _ from "lodash";

export default {
    name: "Cart",
    components: {
        ItemCart,
    },
    data() {
        return {
            isOpen: false,
            items: [],
        };
    },

    mounted() {
        if (localStorage.shoppingCar) {
            this.items = JSON.parse(localStorage.shoppingCar);
        }
        this.$root.$on("add-product", (data) => {
            let product = _.find(this.items, { id: data.id });
            if (product) {
                product.count = product.count + 1;
                product.total = product.total + product.price;
                localStorage.setItem("shoppingCar", JSON.stringify(this.items));
            } else {
                this.items.push({
                    id: data.id,
                    name: data.name,
                    count: 1,
                    stock: parseInt(data.stock),
                    price: parseInt(data.price),
                    total: parseInt(data.price),
                    image: data.image_route,
                });
            }
            this.$root.$emit("show-alert", {
                type: "success",
                title: "Producto Agregado",
                message: "Se ha añadido un producto al carrito de compras",
            });
        });
    },

    watch: {
        items() {
            localStorage.setItem("shoppingCar", JSON.stringify(this.items));
        },
    },
    computed: {
      getTotal(){
          let total = 0;
          this.items.forEach((item) => {
              total =  total + (item.price*item.count)
          })
          return total
      }
    },
    methods: {
        updateItem(item) {
            if (item.count >= 1) {
                let product = _.find(this.items, { id: item.id });
                product.count = item.count;
                product.total = product.price * item.count;
            } else {
                this.items = _.remove(this.items, (data) => {
                    return data.id !== item.id;
                });
            }
            localStorage.setItem("shoppingCar", JSON.stringify(this.items));
        },
        processPayment() {
            axios
                .post("/api/payment/process", {
                    "cart-items": this.items,
                })
                .then((response) => {
                    localStorage.removeItem('shoppingCar')
                    window.location.href = '/payment/process/'+response.data.payment.id;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
};
</script>
