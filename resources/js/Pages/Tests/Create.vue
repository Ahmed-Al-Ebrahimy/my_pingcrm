<template>
    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden lg:w-1/2 rounded sm:rounded-lg">
                    <div class="shadow-lg  rounded-lg border-2 border-red-600">
                    <form id="create_address" @submit.prevent="submit()">

                        <div class="bg-indigo-400 p-1 rounded-lg">
                             <div class="flex justify-center  bg-indigo-800 rounded-md rounded-b-none  mr-1 ml-1 p-0  shadow-lg text-gray-100">
                                <h1 class=" font-bold text-xl">
                                    <h1 class="font-bold text-xl">
                                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('tests')">Tests</inertia-link>
                                    <span class="text-indigo-400 font-medium">/</span> Create a new test
                                    </h1>
                                </h1>
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Test Name  </span>
                                    </div>
                                    <input  placeholder="Test Name"  v-model="form.name"  type="text" class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.name">{{errors.name[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Full Name </span>
                                    </div>
                                    <input placeholder="Test Full Name"  v-model="form.testFullName"  type="text" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <span class="text-sm text-red-600 mt-1 ml-2" v-if="errors.testFullName">{{errors.testFullName[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Normal Value</span>
                                    </div>
                                    <input  placeholder="Test Normal Value"  v-model="form.testNormalValue"  type="text" class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">

                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.testNormalValue">{{errors.testNormalValue[0]}}</span>
                                </div>
                            </div>





                        </div>

                        <div class="px-2 py-1 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">

                            <div class="flex justify-start items-center">
                                <loading-button :loading="sending" class=" bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                     Create test
                                </loading-button>
                            </div>

                            <div></div>

                            <div class="flex justify-self-end items-center">
                                <button type="button"  @click="clearFields"  class="bg-blue-600 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-blue-700 focus:bg-blue-700">
                                     Cleare Fields
                                </button>
                            </div>

                            <div class="flex justify-end items-center">
                                <inertia-link :href="route('tests')" class="bg-red-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
                                    Cleare & Back
                                </inertia-link>
                            </div>

                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import TextInput from '@/Shared/TextInput'
import mapValues from 'lodash/mapValues'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    AppLayout,
    Welcome,
    LoadingButton,
    TextInput,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      form: {
        name: '',
        testFullName: '',
        testNormalValue: '',
      },
      sending: false,
    }
  },
  methods: {
        clearFields(){
         this.form = mapValues(this.form, () => null)
      },
      submit() {
        this.$inertia.post(this.route('tests.store'), this.form, {
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
