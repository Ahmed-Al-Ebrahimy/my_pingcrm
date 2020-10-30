<template>
   <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  lg:w-1/2 rounded sm:rounded-lg">
        <!-- <p v-if="$page.flash.message" class="text-sm">{{ $page.flash.message }}</p> -->
    <!-- <div class="container h-screen mx-auto flex justify-center items-center  md:p-0"> -->
        <div class="shadow-lg  rounded-lg border-2 border-red-600">
            <span class="flex justify-center bg-blue-900  p-2 rounded-b-none rounded-lg text-white"><h2>Header text</h2></span>
            <div class="bg-teal-300 p-1">
                <div class="grid grid-cols-2 p-2">
                    <div class="flex flex-wrap items-stretch w-full relative ">
                        <div class="flex">
                            <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-user"> P.Name</i></span>
                        </div>
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                    </div>

                    <div class="flex flex-wrap items-stretch w-full relative">
                        <div class="flex -mr-px">
                            <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-birthday-cake"> B_Date</i></span>
                        </div>
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                    </div>
                </div>

                <div class="grid grid-cols-2 p-2">
                    <div class="flex flex-wrap items-stretch w-full relative ">
                        <div class="flex">
                            <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-venus-mars"> Gender</i></span>
                        </div>
                        <select required class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                            <option value=""></option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-stretch w-full relative">
                        <div class="flex -mr-px">
                            <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-map-marked-alt"> Address</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                            <option v-for="(a, i) in addresses" :key="i"  :value="a.id" >{{a.addressName}}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 p-2">
                    <div class="flex flex-wrap items-stretch w-full relative ">
                        <div class="flex">
                            <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-ring"> Marital</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                            <option value=""></option>
                            <option value="1">اعزب</option>
                            <option value="2">متزوج</option>
                            <option value="3">ارمل</option>
                            <option value="4">مطلق</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-stretch w-full relative">
                        <div class="flex -mr-px">
                            <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-smoking"> Smoking</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                            <option value=""></option>
                            <option value="1">Smoker</option>
                            <option value="2">Non-Smoker</option>
                            <option value="3">Ex-Smoker</option>
                            <option value="4">Negative Smoker</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 p-2">
                    <div class="flex flex-wrap items-stretch w-full relative ">
                        <div class="flex">
                            <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-school"> Education</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                          <option v-for="(e, i) in educations" :key="i"  :value="e.id" >{{e.educationName}}</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-stretch w-full relative">
                        <div class="flex -mr-px">
                            <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-briefcase"> Occupation</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                          <option v-for="(o, i) in occupations" :key="i"  :value="o.id" >{{o.occupationName}}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 p-2">
                    <div class="flex flex-wrap items-stretch w-full relative ">
                        <div class="flex">
                            <span class="flex items-center leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-diagnoses"> Patient_Type</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                          <option v-for="(p, i) in patient_types" :key="i"  :value="p.id" >{{p.patient_typeName}}</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-stretch w-full relative">
                        <div class="flex -mr-px">
                            <span class="flex items-center ml-2 leading-normal bg-gray-200 rounded rounded-r-none border border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm"><i class="fas fa-history"> F_History</i></span>
                        </div>
                        <select class="flex-shrink flex-grow flex-auto leading-normal w-px  border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                            <option value=""></option>
                            <option value="1">Positive</option>
                            <option value="2">Negative</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="grid grid-cols-2 gap-2 border border-gray-200 p-2 rounded">
                        <div class="flex border rounded bg-gray-300 items-center p-2 ">
                            <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui"
                                        d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                            </svg>
                            <input type="text" placeholder="Enter text here..."
                                    class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                        </div>
                        <div class="flex border rounded bg-gray-300 items-center p-2 ">
                            <svg  class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui"
                                        d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM5.68 7.1A7.96 7.96 0 0 0 4.06 11H5a1 1 0 0 1 0 2h-.94a7.95 7.95 0 0 0 1.32 3.5A9.96 9.96 0 0 1 11 14.05V9a1 1 0 0 1 2 0v5.05a9.96 9.96 0 0 1 5.62 2.45 7.95 7.95 0 0 0 1.32-3.5H19a1 1 0 0 1 0-2h.94a7.96 7.96 0 0 0-1.62-3.9l-.66.66a1 1 0 1 1-1.42-1.42l.67-.66A7.96 7.96 0 0 0 13 4.06V5a1 1 0 0 1-2 0v-.94c-1.46.18-2.8.76-3.9 1.62l.66.66a1 1 0 0 1-1.42 1.42l-.66-.67zM6.71 18a7.97 7.97 0 0 0 10.58 0 7.97 7.97 0 0 0-10.58 0z"/>
                            </svg>
                            <input type="text" placeholder="Enter text here..."
                                    class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 border border-gray-200 p-2 rounded">
                        <div class="flex border rounded bg-gray-300 items-center p-2 ">
                            <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui"
                                        d="M14 5.62l-4 2v10.76l4-2V5.62zm2 0v10.76l4 2V7.62l-4-2zm-8 2l-4-2v10.76l4 2V7.62zm7 10.5L9.45 20.9a1 1 0 0 1-.9 0l-6-3A1 1 0 0 1 2 17V4a1 1 0 0 1 1.45-.9L9 5.89l5.55-2.77a1 1 0 0 1 .9 0l6 3A1 1 0 0 1 22 7v13a1 1 0 0 1-1.45.89L15 18.12z"/>
                            </svg>
                            <input type="text" placeholder="Enter text here..."
                                    class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                        </div>
                        <div class="flex border rounded bg-gray-300 items-center p-2 ">
                            <svg class="fill-current text-gray-800 mr-2 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui"
                                        d="M13.04 14.69l1.07-2.14a1 1 0 0 1 1.2-.5l6 2A1 1 0 0 1 22 15v5a2 2 0 0 1-2 2h-2A16 16 0 0 1 2 6V4c0-1.1.9-2 2-2h5a1 1 0 0 1 .95.68l2 6a1 1 0 0 1-.5 1.21L9.3 10.96a10.05 10.05 0 0 0 3.73 3.73zM8.28 4H4v2a14 14 0 0 0 14 14h2v-4.28l-4.5-1.5-1.12 2.26a1 1 0 0 1-1.3.46 12.04 12.04 0 0 1-6.02-6.01 1 1 0 0 1 .46-1.3l2.26-1.14L8.28 4zm7.43 5.7a1 1 0 1 1-1.42-1.4L18.6 4H16a1 1 0 0 1 0-2h5a1 1 0 0 1 1 1v5a1 1 0 0 1-2 0V5.41l-4.3 4.3z"/>
                            </svg>
                            <input type="text" placeholder="Enter text here..."
                                    class="bg-gray-300 max-w-full focus:outline-none text-gray-700"/>
                        </div>
                    </div>
                </div>

                </div>

                    <div class="grid grid-cols-2 bg-blue-900  p-2 rounded-t-none rounded-lg">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <select class="border p-2 rounded  mr-1">
                                <option>Choose Destination</option>
                                <option v-for="(d, i) in destinations" :key="i"  :value="d.id" >{{d.destinationName}}</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Choose Clinic</option>
                                <option v-for="(c, i) in clinics" :key="i"  :value="c.id" >{{c.clinicName}}</option>
                            </select>
                        </div>
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <button class="p-2 border w-1/2 rounded-md bg-gray-800 text-white" @click="closeModal()">Cancel </button>
                            <button class="p-2 border w-1/2 rounded-md bg-gray-800 text-white" @click="save(form)" wire:click.prevent="store()"> Save </button>
                        </div>
                    </div>
            </div>

        </div>
                </div></div>
    <!-- </div> -->
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
      submit() {
        this.$inertia.post(this.route('addresses.store'), this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
        })
      },
  },
}
</script>

