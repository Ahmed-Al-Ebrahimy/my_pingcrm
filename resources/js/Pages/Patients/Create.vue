<template>
    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  lg:w-1/2 rounded sm:rounded-lg">
                    <div class="shadow-lg  rounded-lg border-2 border-red-600">
                        <span class="flex justify-center bg-blue-900  p-2 rounded-b-none rounded-lg text-white"><h2>Header text</h2></span>
                        <div class="bg-teal-300 p-1">
                            <form id="create_address" @submit.prevent="submit()">
                            <div class="grid grid-cols-2 p-2">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="flex">
                                        <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">P.Name</span>
                                    </div>
                                    <input required v-model="form.name" type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Patient name">
                                    <span class="text-sm text-red-600 mt-1" v-if="errors.name">{{errors.name[0]}}</span>
                                </div>

                                <div class="flex  items-stretch w-full relative">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">BirthDate</span>
                                    </div>
                                    <input required v-model="form.birth_date"  type="date" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.birth_date">{{errors.birth_date[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-2">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="flex">
                                        <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Gender</span>
                                    </div>
                                    <select required v-model="form.gender"  class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    <span class="text-sm text-red-600 mt-1" v-if="errors.gender">{{errors.gender[0]}}</span>
                                </div>


                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Address</span>
                                    </div>
                                    <select required v-model="form.address_id"  class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                        <option v-for="(address, i) in addresses" :key="i"  :value="address.id" >{{address.name}}</option>
                                    </select>
                                    <span class="text-sm ml-2  text-red-600 mt-1" v-if="errors.address_id">{{errors.address_id[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-2">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="flex">
                                        <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Marital</span>
                                    </div>
                                    <select required v-model="form.marital" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                        <option value="1">اعزب</option>
                                        <option value="2">متزوج</option>
                                        <option value="3">ارمل</option>
                                        <option value="4">مطلق</option>
                                    </select>
                                    <span class="text-sm text-red-600 mt-1" v-if="errors.marital">{{errors.marital[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Smoking</span>
                                    </div>
                                    <select required v-model="form.smoking" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                        <option value="1">Smoker</option>
                                        <option value="2">Non-Smoker</option>
                                        <option value="3">Ex-Smoker</option>
                                        <option value="4">Negative Smoker</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.smoking">{{errors.smoking[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-2">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="flex">
                                        <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Education</span>
                                    </div>
                                    <select required v-model="form.educationlevel_id" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                    <option v-for="(education, i) in educationlevels" :key="i"  :value="education.id" >{{education.name}}</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.educationlevel_id">{{errors.educationlevel_id[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Occupation</span>
                                    </div>
                                    <select required v-model="form.occupation_id" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                    <option v-for="(occupation, i) in occupations" :key="i"  :value="occupation.id" >{{occupation.name}}</option>
                                    </select>
                                     <span class="text-sm  ml-2 text-red-600 mt-1" v-if="errors.occupation_id">{{errors.occupation_id[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 p-2">
                                <div class="flex flex-wrap items-stretch w-full relative ">
                                    <div class="flex">
                                        <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">Patient_Type</span>
                                    </div>
                                    <select required v-model="form.type_id" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                    <option v-for="(type, i) in types" :key="i"  :value="type.id" >{{type.name}}</option>
                                    </select>
                                     <span class="text-sm text-red-600 mt-1" v-if="errors.type_id">{{errors.type_id[0]}}</span>
                                </div>

                                <div class="flex flex-wrap items-stretch w-full relative">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center  leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">F_History</span>
                                    </div>
                                    <select required v-model="form.fh_of_dm" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                                        <option value="1">Positive</option>
                                        <option value="2">Negative</option>
                                    </select>
                                    <span class="text-sm ml-2 text-red-600 mt-1" v-if="errors.fh_of_dm">{{errors.fh_of_dm[0]}}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="grid grid-cols-2 gap-2 border border-gray-200 p-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                        <input type="text" placeholder="Enter text here..."
                                        class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                                    </div>
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                        <input type="text" placeholder="Enter text here..."
                                        class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 border border-gray-200 p-2 rounded">
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                        <input type="text" placeholder="Enter text here..."
                                            class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                                    </div>
                                    <div class="flex border rounded bg-gray-300 items-center p-2 ">
                                        <input type="text" placeholder="Enter text here..."
                                        class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 bg-banafsagy-900 rounded-t-none rounded-md flex justify-end items-center">
                                <loading-button :loading="sending"
                                 class="border border-pink-500 bg-indigo-800  text-gray-300 px-3 py-1 shadow-md  hover:bg-indigo-900 rounded-md"
                                  type="submit">Create Patient</loading-button>
                            </div></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

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
      },
      sending: false,
    }
  },
  methods: {
      submit() {
        this.$inertia.post(this.route('patients.store'), this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
        })
      },
  },
}
</script>
