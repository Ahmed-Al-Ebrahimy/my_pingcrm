<template>
    <app-layout>
        <div class="px-1 flex flex-col">
            <div class="w-full mb-4"> <form id="update_profile" @submit.prevent="submit()">
                <div class="bg-white rounded shadow overflow-x-auto">

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="bg-indigo-800 text-gray-300">
                            <th class="border border-blue-400 px-2 py-1 text-center">Name</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">BirthDate</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">Address</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">Gender</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">marital</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">smoking</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">Education</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">Occupation</th>
                            <th class="border border-blue-400 px-2 py-1 text-center">DMFH</th>
                            <th class="border  border-blue-400 px-2 py-1 text-center">Created_at</th>
                        </tr>
                    </thead>
                    <tr class="font-medium text-gray-800">
<!--
                        <td class="border border-blue-400">
                            <input v-model="form.id"  type="text">
                        </td> -->

                         <td class="border border-blue-400">
                            <input v-model="form.name"  type="text" class="rtl px-1 w-full">
                        </td>
                         <td class="border border-blue-400">
                            <input v-model="form.birth_date"  type="text" class="w-full">
                        </td>
                         <td class="border border-blue-400">
                            <select v-model="form.address_id" class="w-full">
                                <option v-for="(address, i) in addresses" :key="i"  :value="address.id" >{{address.name}}</option>
                            </select>
                        </td>
                         <td class="border border-blue-400">
                            <select v-model="form.gender"  class="w-full">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </td>

                        <td class="border border-blue-400">
                            <select v-model="form.marital" class="w-full">
                                <option value="1">اعزب</option>
                                <option value="2">متزوج</option>
                                <option value="3">ارمل</option>
                                <option value="4">مطلق</option>
                            </select>
                        </td>

                        <td class="border border-blue-400">
                            <select v-model="form.smoking" class="w-full">
                                <option value="1">Smoker</option>
                                <option value="2">Non-Smoker</option>
                                <option value="3">Ex-Smoker</option>
                            </select>
                        </td>

                        <td class="border border-blue-400">
                            <select v-model="form.educationlevel_id" class="w-full bg-indigo-300">
                                <option v-for="(education, i) in educationlevels" :key="i"  :value="education.id" >{{education.name}}</option>
                            </select>
                        </td>

                        <td class="border border-blue-400">
                            <select v-model="form.occupation_id" class="w-full px-1">
                                <option v-for="(occupation, i) in occupations" :key="i"  :value="occupation.id" >{{occupation.name}}</option>
                            </select>
                        </td>
                        <td class="border border-blue-400">
                            <select v-model="form.fh_of_dm" class="w-full">
                                <option value="1">Positive</option>
                                <option value="2">Negative</option>
                            </select>
                        </td>

                        <td class="border border-blue-400">
                            {{moment(patient.created_at).format('YYYY-MM-DD')}}
                        </td>

                    </tr>
                    <tr v-if="!patient">
                        <td class="border-t px-6 py-4" colspan="6">No patient found.</td>
                    </tr>
                </table>
            </div></form>
            </div>


            <div class="px-2 sm:px-2 md:px-1  flex w-full  sm:w-1/4 md:w-1/3 lg:w-2/4 mr-2">
                <div class="overflow-hidden rounded sm:rounded-md">
                    <div class="p-1  bg-indigo-600 rounded-md border-2 border-red-600">
                        <div class="mb-1 flex justify-center  bg-indigo-800 rounded-md rounded-b-none shadow-lg text-gray-100">
                            <span> Patient Visits Information </span>
                        </div>
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="bg-indigo-800 text-gray-200">
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Visit Date</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Systolic_bp</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Diastolic_bp</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Height</th>
                                    <th class="border border-gray-400 text-left px-2 py-1 text-sm">Weight</th>
                                </tr>
                            </thead>
                            <tr v-for="(visit, index) in patient.visits" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-blue-300': index % 2 === 0}">
                                <td class="border border-gray-400 text-left px-2">{{moment(visit.created_at).format('YYYY-MM-DD')}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.systolic_bp}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.diastolic_bp}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.height}}</td>
                                <td class="border border-gray-400 text-left px-2">{{visit.weight}}</td>

                            </tr>
                            <tr v-if="patient.visits.length === 0">
                                <td class="border-t px-6 py-4" colspan="6">No Visits found..!!</td>
                            </tr>
                        </table>
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
    addresses: Array,
    educationlevels: Array,
    occupations: Array,
    types: Array,
    patient: Object,
    todays_visit: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name:               this.patient.name,
        birth_date:         this.patient.birth_date,
        gender:             this.patient.gender,
        marital:            this.patient.marital,
        smoking:            this.patient.smoking,
        fh_of_dm:           this.patient.fh_of_dm,

        address_id:         this.patient.address_id,
        occupation_id:      this.patient.occupation_id,
        educationlevel_id:  this.patient.educationlevel_id,
        type_id:            this.patient.type_id,

        systolic_bp:        this.todays_visit.systolic_bp,
        diastolic_bp:       this.todays_visit.diastolic_bp,
        height:             this.todays_visit.height,
        weight:             this.todays_visit.weight,

      },
      sending: false,
    }
  },
  methods: {

    submit() {
        let data = new FormData();
        data.append('name', this.form.name);
        data.append('birth_date', this.form.birth_date);
        data.append('gender', this.form.gender);
        data.append('marital', this.form.marital);
        data.append('smoking', this.form.smoking);
        data.append('fh_of_dm', this.form.fh_of_dm);

        data.append('address_id', this.form.address_id);
        data.append('occupation_id', this.form.occupation_id);
        data.append('educationlevel_id', this.form.educationlevel_id);
        data.append('type_id', this.form.type_id);

        data.append('systolic_bp', this.form.systolic_bp);
        data.append('diastolic_bp', this.form.diastolic_bp);
        data.append('height', this.form.height);
        data.append('weight', this.form.weight);

        data.append('_method', 'PUT');

        this.$inertia.post(this.route('patients.update', {patient: this.patient.id}), data, {
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
