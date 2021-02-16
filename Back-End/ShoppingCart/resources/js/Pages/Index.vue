<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Products To Cart
            </h2>
        </template>

              <div v-for="product in products" v-bind:key="product.id" class="flex justify-center items-center min-h-screen bg-gray-100">
                <div  class="w-full md:w-1/3  p-2">


                  <div class="bg-white shadow-lg hover:shadow-xl rounded-lg ">
                    <div class="bg-gray-400 h-64 rounded-t-lg p-4 bg-no-repeat bg-center bg-cover">
                      <div class="text-right">
                        <img  :src="product.image">
                        <button class="text-pink-500 hover:text-pink-600 p-2 rounded-full" style="background: rgba(0,0,0,0.3)">
                          <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                          </svg>
                        </button>
                      </div>
                    </div>
                    <div class="flex justify-between items-start px-2 pt-2">
                      <div class="p-2 flex-grow">
                        <h1 class="font-medium text-xl font-poppins">{{product.title}}</h1>
                        <p class="text-gray-500 font-nunito">{{product.description}}+</p>
                      </div>
                      <div class="p-2 text-right">
                        <div class="text-teal-500 font-semibold text-lg font-poppins">{{product.price}}</div>
                        <div class="text-xs text-gray-500 line-through font-poppins">1000$</div>
                      </div>
                    </div>
                    <div class="flex justify-center items-center px-2 pb-2">
                      <div class="w-1/2 p-2">
                        <input type="number" v-model="Quantity" min="1" max="10" class="outline-none focus:outline-none text-center w-full bg-white-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="0"></input>
                      </div>
                      <div class="w-1/2 p-2">
                        <button @click="AddToCart(product.id)" class="block w-full bg-white hover:bg-gray-100 text-teal-500 border-2 border-teal-500 px-3 py-2 rounded uppercase font-poppins font-medium">
                          Add to cart
                        </button>
                      </div>
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
          products : Array
        },
        data(){
        return{
          Quantity : 1,
        }

        },
        methods:{
          AddToCart(pro){
            this.$inertia.post('/Cart/add',{Quantity:this.Quantity,Product:pro})
          }
        }
    }
</script>
