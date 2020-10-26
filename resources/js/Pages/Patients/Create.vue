<template>
 <app-layout>
<div>
<h1 class="mb-8 font-bold text-3xl">
    <h1 class=""> Create new patient</h1>
</h1>
<div class="bg-white rounded shadow overflow-hidden max-w-3xl">
    <form id="create_patient" @submit.prevent="submit()">

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="name"/>
        <div class="text-sm text-red-600 mt-1" required="required" v-if="errors.name">{{errors.name[0]}}</div>
    </div>

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input type="date" v-model="form.birth_date" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="birth_date"/>
        <div class="text-sm text-red-600 mt-1" v-if="errors.birth_date">{{errors.birth_date[0]}}</div>
    </div>

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <select v-model="form.gender" class="pr-6 pb-8 w-full lg:w-1/2 border-b ">
            <option :value="null" />
            <option value="1">Male</option>
            <option value="2">Femail</option>
        </select>
        <div class="text-sm text-red-600 mt-1" v-if="errors.gender">{{errors.gender[0]}}</div>
    </div>

    <!-- <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input @change="setPhoto" type="file" accept="image/*" id="photo">
        <div class="" v-if="errors.photo">{{errors.photo[0]}}</div>
    </div> -->


    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
        <button  class="btn-indigo" :loading="sending"  type="submit">Create patient</button>
    </div>

    </form>
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
  },
  data() {
    return {
      form: {
        name: '',
        birth_date: null,
        gender: null,
        photo: null,
      },
      sending: false,
    }
  },
  methods: {

    //   setPhoto() {
    //             if (this.$refs.photo) {
    //                 this.form.photo = this.$refs.photo.files[0]
    //             }
    //         },
      submit() {
            // let data = new FormData();
            // data.append('name', this.form.name);
            // data.append('birth_date', this.form.birth_date);
            // data.append('gender', this.form.gender);
            // // data.append('photo', this.form.photo);
            // this.$inertia.post(this.route('patients.store'), data, {
            //     onStart: () => this.sending = true,
            //     onFinish: () => this.sending = false,
            // })

        this.$inertia.post(this.route('patients.store'), this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
        })
      },
  },
}
</script>
