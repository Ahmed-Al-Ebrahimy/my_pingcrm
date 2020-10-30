<template>
 <app-layout>
<div>
<h1 class="mb-8 font-bold text-3xl">
    <h1 class=""> Create new address</h1>
</h1>
<div class="bg-white rounded shadow overflow-hidden max-w-3xl">
    <form id="create_address" @submit.prevent="submit()">

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="name"/>
        <div class="text-sm text-red-600 mt-1" v-if="errors.name">{{errors.name[0]}}</div>
    </div>

    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">

         <loading-button :loading="sending" class="btn-indigo" type="submit">Create Address</loading-button>
        <!-- <button  class="btn-indigo" :loading="sending"  type="submit">Create address</button> -->
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
