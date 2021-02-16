<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Shopping Cart
            </h2>
        </template>


        <div class="container mx-auto mt-10">


          <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
              <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
              </div>
              <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
              </div>

              <div v-for="item in items" v-bind:key="item.id" class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                <div class="flex w-2/5"> <!-- product -->
                  <div class="w-20">
                    <img class="h-24" :src="item.image" alt="">
                  </div>
                  <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="font-bold text-sm">{{item.name}}</span>
                    <button @click="RemoveFromCart(item.rowId)"  class="font-semibold hover:text-red-500 text-gray-500 text-xs">
                      Remove
                    </button>
                    <a ></a>
                  </div>
                </div>
                <div class="flex justify-center w-1/5">
                  <button @click="UpdateFromCart(item.rowId,item.qty,0)">
                    <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/> </svg>
                  </button>
                  <input  min="1" max="10" class="outline-none focus:outline-none text-center w-full bg-white-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" :value="item.qty"></input>
                  <button @click="UpdateFromCart(item.rowId,item.qty,1)">
                    <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"> <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/> </svg>
                  </button>
                </div>

                <span class="text-center w-1/5 font-semibold text-sm">{{item.price}}$</span>
                <span class="text-center w-1/5 font-semibold text-sm">{{item.price * item.qty}}$</span>
              </div>



              <inertia-link  as="button" :href="`/Products`"  class="flex font-semibold text-indigo-600 text-sm mt-10" > <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg> Continue Shopping</inertia-link>

            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
              <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
              <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">SubTotal : </span>
                <span class="font-semibold text-sm">{{subtotal}}$</span>
              </div>
              <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">Tax : </span>
                <span class="font-semibold text-sm">{{tax}}$</span>
              </div>
              <div class="py-10">
                <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                <input v-model="coupon" type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
              </div>
              <button @click="UseCoupons()" class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
              <div class="border-t mt-8">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                  <span>Total cost</span>
                  <span>{{total}}</span>
                </div>
                <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
              </div>
            </div>

          </div>


        </div>



    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },
        props:{
          items : Array,
          subtotal: String,
          tax: String,
          total: String
        },
        data(){
        return{
          coupon : '',
        }

        },
        methods:{
          RemoveFromCart(row){
            this.$inertia.post('/Cart/remove',{row})
          },
          UpdateFromCart(row,qty,type){
            this.$inertia.post('/Cart/update',{row,qty,type})
          },
          UseCoupons(){
            this.$inertia.post('/Cart/coupon',{coupon:this.coupon})
          }
        }

    }
</script>
