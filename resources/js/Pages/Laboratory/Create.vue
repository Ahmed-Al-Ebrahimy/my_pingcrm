<template>
    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden lg:w-1/2 rounded sm:rounded-lg">
                    <div class="shadow-lg  rounded-lg border-2 border-red-600">
                    <form id="create_address" @submit.prevent="submit()">
                        <!-- <span class="flex justify-left bg-indigo-900  p-1 rounded-b-none rounded-lg text-white">
                            <h2>Creat a new Patient</h2>
                        </span> -->

                        <div class="bg-indigo-400 p-1 rounded-lg">
                             <div
                              class="flex justify-center  bg-indigo-800 rounded-md rounded-b-none  mr-1 ml-1 p-0  shadow-lg text-gray-100">
                                Profile Information
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex -mr-px ">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Name  </span>
                                    </div>
                                    <input  placeholder="Patient name"    v-model="form.name"  type="text" class="rtl text-center placeholder-pink-400 p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">

                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.name">{{errors.name[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">BirthDate </span>
                                    </div>
                                    <input    v-model="form.birth_date"  type="date" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">

                                    <span class="text-sm text-red-600 mt-1 ml-2" v-if="errors.birth_date">{{errors.birth_date[0]}}</span>
                                </div>


                            </div>

                            <div class="grid grid-cols-2 p-1">
                                  <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex -mr-px">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Gender</span>
                                    </div>
                                     <select    v-model="form.gender"  class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.gender">{{errors.gender[0]}}</span>
                                </div>


                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="w-1/3 flex -mr-px">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Address</span>
                                    </div>
                                    <select    v-model="form.address_id"  class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative">
                                        <option v-for="(address, i) in addresses" :key="i"  :value="address.id" >{{address.name}}</option>
                                    </select>
                                    <span class="text-sm ml-2  text-red-600 mt-1" v-if="errors.address_id">{{errors.address_id[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Marital</span>
                                    </div>
                                    <select    v-model="form.marital" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                        <option value="1">اعزب</option>
                                        <option value="2">متزوج</option>
                                        <option value="3">ارمل</option>
                                        <option value="4">مطلق</option>
                                    </select>
                                    <span class="text-sm text-red-600 mt-1" v-if="errors.marital">{{errors.marital[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="w-1/3 flex -mr-px">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Smoking</span>
                                    </div>
                                    <select    v-model="form.smoking" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                        <option value="1">Smoker</option>
                                        <option value="2">Non-Smoker</option>
                                        <option value="3">Ex-Smoker</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.smoking">{{errors.smoking[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Education</span>
                                    </div>
                                    <select    v-model="form.educationlevel_id" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <option v-for="(education, i) in educationlevels" :key="i"  :value="education.id" >{{education.name}}</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.educationlevel_id">{{errors.educationlevel_id[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="w-1/3 flex -mr-px">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">Occupation</span>
                                    </div>
                                    <select    v-model="form.occupation_id" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <option v-for="(occupation, i) in occupations" :key="i"  :value="occupation.id" >{{occupation.name}}</option>
                                    </select>
                                     <span class="text-sm  ml-2 text-red-600 mt-1" v-if="errors.occupation_id">{{errors.occupation_id[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="w-1/3 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">D_Type</span>
                                    </div>
                                    <select    v-model="form.type_id" class=" p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                    <option v-for="(type, i) in types" :key="i"  :value="type.id" >{{type.name}}</option>
                                    </select>
                                     <span class="text-sm text-red-600 mt-1" v-if="errors.type_id">{{errors.type_id[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="w-1/3 flex -mr-px">
                                        <span class="w-full flex items-center leading-normal ml-2 bg-gray-400 rounded rounded-r-none border border-gray-500 px-3 whitespace-no-wrap text-grey-dark text-sm">F_History</span>
                                    </div>
                                    <select    v-model="form.fh_of_dm" class="p-1 px-2 rounded-sm bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-10 border-gray-500   rounded-l-none relative ">
                                        <option value="1">Positive</option>
                                        <option value="2">Negative</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.fh_of_dm">{{errors.fh_of_dm[0]}}</span>
                                </div>
                            </div>


                            <div class="flex justify-center  bg-indigo-800 m-1 p-0  shadow-lg text-gray-100">
                                Visit Information
                            </div>

                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="grid grid-cols-2 gap-2 ">
                                    <div class="p-1">
                                        <input type="text"    v-model="form.systolic_bp" placeholder="Systolic_bp"
                                            class="p-1 px-2 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.systolic_bp">{{errors.systolic_bp[0]}}</span>
                                    </div>
                                    <div class="p-1">
                                        <input type="text"    v-model="form.diastolic_bp" placeholder="Diastolic_bp"
                                            class="p-1 px-2 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.diastolic_bp">{{errors.diastolic_bp[0]}}</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="p-1">
                                        <input type="text"    v-model="form.height" placeholder="Height"
                                            class="p-1 px-2 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.height">{{errors.height[0]}}</span>
                                    </div>
                                    <div class="p-1">
                                        <input type="text"    v-model="form.weight" placeholder="Weight"
                                            class="p-1 px-2 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.weight">{{errors.weight[0]}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="px-2 py-1 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">

                            <div class="flex justify-start items-center">
                                <loading-button :loading="sending" class=" bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                     Create Patient
                                </loading-button>
                            </div>

                            <div></div>

                            <div class="flex justify-self-end items-center">
                                <button type="button"  @click="clearFields"  class="bg-blue-600 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-blue-700 focus:bg-blue-700">
                                     Cleare Fields
                                </button>
                            </div>

                            <div class="flex justify-end items-center">
                                <inertia-link :href="route('patients')" class="bg-red-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
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
    addresses: Array,
    educationlevels: Array,
    occupations: Array,
    types: Array,
  },
  data() {
    return {
      form: {
        name: '',
        birth_date: null,
        gender: null,
        marital: null,
        smoking: null,
        fh_of_dm: null,
        occupation_id: null,
        educationlevel_id: null,
        address_id: null,
        type_id: null,


        systolic_bp: null,
        diastolic_bp: null,
        height: null,
        weight: null,
      },
      sending: false,
    }
  },
  methods: {
      clearFields(){
         this.form = mapValues(this.form, () => null)
      },
      submit() {
        this.$inertia.post(this.route('patients.store'), this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
        })
      },
  },
}
</script>
