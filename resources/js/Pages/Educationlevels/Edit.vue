<template>
    <app-layout>
        <div class="py-6">
            <div class="px-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden lg:w-1/2  rounded-md border-2 border-red-500">
                    <form id="create_educationlevel" @submit.prevent="submit()">

                        <div class="bg-indigo-400 rounded-md">
                             <div class="flex justify-center  bg-indigo-800 rounded-md rounded-b-none shadow-lg text-gray-100">
                                <h1 class=" font-bold text-xl">
                                    <h1 class="font-bold text-xl">
                                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('educationlevels')">Educationlevels</inertia-link>
                                    <span class="text-indigo-400 font-medium">/</span> Update
                                    </h1>
                                </h1>
                            </div>
                            <div class="grid grid-cols-1 p-1">
                                <div class="flex flex-wrap items-stretch w-3/4 relative p-3 ml-6">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Name </span>
                                    </div>
                                    <input required placeholder="Educationlevel Name"  v-model="form.name"  type="text" class="p-1 px-2 rounded-md bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                </div>
                                <div v-if="errors.name" class="flex w-3/4 relative pl-2 ml-12">
                                     <span class="text-sm ml-2 text-red-600">{{errors.name[0]}}</span>
                                </div>
                            </div>
                            <!-- <div class="grid grid-cols-1 p-3 w-3/4">
                                <div class="flex flex-wrap items-stretch w-full relative ml-8">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Name  </span>
                                    </div>
                                    <input  placeholder="educationlevel Name"  v-model="form.name"  type="text" class="p-1 px-2 rounded-md bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.name">{{errors.name[0]}}</span>
                                </div>
                            </div> -->
                        </div>

                        <div class="px-2 py-1 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">

                            <div class="flex justify-start items-center">
                                <loading-button :loading="sending" class=" bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                     Update Educationlevel
                                </loading-button>
                            </div>

                            <div></div>
                            <div></div>

                            <div class="flex justify-end items-center">
                                <button type="button" @click="destroy" class="bg-red-600 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-blue-700 focus:bg-blue-700">
                                     Delete Educationlevel
                                </button>
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
import Icon from '@/Shared/Icon'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    AppLayout,
    Welcome,
    LoadingButton,
    Icon,
  },
  props: {
    educationlevel: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: this.educationlevel.name,
      },
      sending: false,
    }
  },
  methods: {
    submit() {
        let data = new FormData();
        data.append('name', this.form.name);
        data.append('_method', 'PUT');

        this.$inertia.post(this.route('educationlevels.update', {educationlevel: this.educationlevel.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    destroy() {
      if (confirm('Are you sure you want to delete this educationlevel?')) {
        this.$inertia.post(this.route('educationlevels.destroy', this.educationlevel.id))
      }
    },
  },
}
</script>
