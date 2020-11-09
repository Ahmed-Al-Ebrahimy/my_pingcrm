<template>
    <app-layout>
        <div class="py-6 px-1 flex flex-col lg:flex-row">


            <div class="px-6 sm:px-2 md:px-1   flex w-full sm:w-3/4 md:w-2/3  lg:w-2/4 mr-2">
                    <div class="bg-banafsagy-600 overflow-hidden rounded sm:rounded-lg">
                        <div class="shadow-lg  rounded-lg border-2 border-red-600">
                        <form  id="form" @submit.prevent="submit()">
                            <div class="bg-indigo-400 rounded-lg">

                                <div class="grid grid-cols-4 p-1">
                                    <div class="flex flex-wrap items-stretch w-full relative p-px" v-for="(test, i) in tests" :key="i" >
                                        <div class="w-1/2 flex">
                                            <span class="w-full flex items-center leading-normal bg-gray-400 rounded rounded-r-none border border-gray-500 p-1 h-7 whitespace-no-wrap text-grey-dark text-sm">{{test.name}}  </span>
                                        </div>
                                        <input autocomplete="off" :name="test.id" :value="test.value"  type="text" class="rounded bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-7 p-1 border-gray-500   rounded-l-none relative ">
                                    </div>


                                </div>


                            </div>

                            <div class="py-2 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">
                                <div class="flex justify-start items-center pl-2 pr-2">
                                    <loading-button :loading="sending" class="bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                        Update Patient
                                    </loading-button>
                                </div>
                                <div class="flex justify-self-start items-center">
                                    <inertia-link :href="route('patients')" class="bg-red-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
                                        Cancel & Back
                                    </inertia-link>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>

            </div>

            <div class="px-6 sm:px-2 md:px-1  flex w-full  sm:w-1/4 md:w-1/3 lg:w-2/4 mr-2">
                <div class="overflow-hidden rounded sm:rounded-lg">
                    <div class="p-1  bg-banafsagy-600 rounded-lg border-2 border-red-600">
                        <div class="mb-1 flex justify-center  bg-indigo-800 rounded-md rounded-b-none shadow-lg text-gray-100">
                            <span> Patient Visits Information </span>
                        </div>
                        <!-- <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="bg-indigo-800 text-gray-200">
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Visit Date</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Systolic_bp</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Diastolic_bp</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Height</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Weight</th>
                                </tr>
                            </thead>
                            <tr v-for="(test, index) in patient.visits" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-blue-300': index % 2 === 0}">
                                <td class="border border-gray-400 text-left px-2">{{moment(test.created_at).format('YYYY-MM-DD')}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.systolic_bp}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.diastolic_bp}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.height}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.weight}}</td>

                            </tr>
                            <tr v-if="patient.visits.length === 0">
                                <td class="border-t px-6 py-4" colspan="6">No Visits found..!!</td>
                            </tr>
                        </table> -->
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
    tests: Array,
    patient: Object,
    todays_visit: Object,
    errors: Object,
  },
  data() {
    return {
        // name:               this.patient.name,
        // patient_id:         this.patient.id,
        // visit_id:            this.todays_visit.id,

        sending: false,
    }
  },
  methods: {

    submit() {
            var form = document.getElementById('form');
            var data = new FormData(form);
            data.append('_method', 'PUT');

        this.$inertia.post(this.route('laboratory.update', {patient: this.patient.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    destroy() {
      if (confirm('Are you sure you want to delete this patient?')) {
        this.$inertia.post(this.route('patients.destroy', this.patient.id))
      }
    },
  },
}
</script>
