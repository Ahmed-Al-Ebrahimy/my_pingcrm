<template>
    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden lg:w-1/2  rounded-md border-2 border-red-500">
                    <form id="create_address" @submit.prevent="submit()">

                        <div class="bg-indigo-400  rounded-md">
                             <div class="flex justify-center  bg-indigo-800 rounded-md rounded-b-none shadow-lg text-gray-100">
                                <h1 class=" font-bold text-xl">
                                    <h1 class="font-bold text-xl">
                                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('educationlevels')">Educationlevels</inertia-link>
                                    <span class="text-indigo-400 font-medium">/</span> Create
                                    </h1>
                                </h1>
                            </div>
                            <div class="grid grid-cols-1 p-1">
                                <div class="flex flex-wrap items-stretch w-3/4 relative p-3 ml-6">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Name </span>
                                    </div>
                                    <input required placeholder="Educationlevel Name"  v-model="form.name"  type="text" class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                </div>
                                <div v-if="errors.name" class="flex w-3/4 relative pl-2 ml-12">
                                     <span class="text-sm ml-2 text-red-600">{{errors.name[0]}}</span>
                                </div>
                            </div>

                        </div>

                        <div class="px-2 py-1 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">
                            <div class="flex justify-start items-center">
                                <loading-button :loading="sending" class=" bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                     Create Educationlevel
                                </loading-button>
                            </div>
                            <div></div>

                            <div class="flex justify-self-end items-center">
                                <button type="button"  @click="clearFields"  class="bg-blue-600 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-blue-700 focus:bg-blue-700">
                                     Cleare Field
                                </button>
                            </div>

                            <div class="flex justify-end items-center">
                                <inertia-link :href="route('educationlevels')" class="bg-red-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
                                    Cleare & Back
                                </inertia-link>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import mapValues from 'lodash/mapValues'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    AppLayout,
    Welcome,
    LoadingButton,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      form: {
        name: '',
      },
      sending: false,
    }
  },
  methods: {

      clearFields(){
         this.form = mapValues(this.form, () => null)
      },

      submit() {
        this.$inertia.post(this.route('educationlevels.store'), this.form, {
          onStart: () => this.sending = true,
           onFinish: () => {
                 this.clearFields(),
                 this.sending = false
          }
        })
      },
  },
}
</script>
