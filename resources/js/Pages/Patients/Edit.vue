<template>
    <app-layout>
        <div class="py-6 px-1 flex flex-col lg:flex-row">


            <div class="px-6 sm:px-2 md:px-1   flex w-full sm:w-3/4 md:w-2/3  lg:w-2/4 mr-2">
                    <div class="bg-banafsagy-600 overflow-hidden rounded sm:rounded-lg">
                        <div class="shadow-lg  rounded-lg border-2 border-red-600">
                        <form id="create_address" @submit.prevent="submit()">
                            <div class="bg-indigo-400 p-1 rounded-lg">
                                <div class="flex justify-center  bg-indigo-800 rounded-md rounded-b-none  mr-1 ml-1 p-0  shadow-lg text-gray-100">
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
                                <span>Today's Visit Information</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ml-1">
                                    <div class="grid grid-cols-2 gap-2 ">
                                        <div class="p-1 w-full items-center  bg-gray-400 rounded  border border-gray-600  whitespace-no-wrap text-grey-dark text-sm">
                                            <label  class="flex justify-start p-0 pb-1 " for="systolic_bp">systolic_bp:</label>
                                            <input autocomplete="off" type="text"  id="systolic_bp"  v-model="form.systolic_bp" placeholder="Systolic_bp"
                                                class="p-1 px-2  border border-gray-600 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.systolic_bp">{{errors.systolic_bp[0]}}</span>
                                        </div>


                                        <div class="p-1 w-full items-center  bg-gray-400 rounded  border border-gray-600  whitespace-no-wrap text-grey-dark text-sm">
                                            <label  class="flex justify-start p-0 pb-1 " for="diastolic_bp">Diastolic_bp:</label>
                                            <input autocomplete="off" type="text" id="diastolic_bp" v-model="form.diastolic_bp" placeholder="Diastolic_bp"
                                                class="p-1 px-2  border border-gray-600 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.diastolic_bp">{{errors.diastolic_bp[0]}}</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 mr-1">
                                        <div class="p-1 w-full items-center  bg-gray-400 rounded  border border-gray-600  whitespace-no-wrap text-grey-dark text-sm">
                                            <label  class="flex justify-start p-0 pb-1 " for="height">Height:</label>
                                            <input autocomplete="off" type="text" id="height" v-model="form.height" placeholder="Height"
                                                class="p-1 px-2 border border-gray-600 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.height">{{errors.height[0]}}</span>
                                        </div>
                                        <div class="p-1  w-full items-center  bg-gray-400 rounded  border border-gray-600  whitespace-no-wrap text-grey-dark text-sm">
                                            <label  class="flex justify-start p-0 pb-1 " for="weight">Weight:</label>
                                            <input autocomplete="off" type="text" id="weight" v-model="form.weight" placeholder="Weight"
                                                class="p-1 px-2  border border-gray-600 rounded-sm bg-gray-200 max-w-full focus:shadow-outline"/>
                                            <span class="text-sm text-red-600 mt-1" v-if="errors.weight">{{errors.weight[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="px-0 py-1 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">
                                <div class="flex justify-start items-center">
                                    <loading-button :loading="sending" class="ml-2 bg-green-500 px-2 py-1 rounded text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
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
                            <tr v-for="(visit, index) in patient.visits" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">
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
