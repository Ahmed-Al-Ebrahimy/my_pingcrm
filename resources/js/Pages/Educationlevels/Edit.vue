<template>
 <app-layout>
<div>
<div class="mb-8 font-bold text-3xl">
    <h1 class=""> Edit educationlevel</h1>
</div>
<div class="bg-white rounded shadow overflow-hidden max-w-3xl">
    <form id="update_educationlevel" @submit.prevent="submit()">

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="name"/>
        <div class="text-sm text-red-600 mt-1" required="required" v-if="errors.name">{{errors.name[0]}}</div>
    </div>
    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
        <button v-if="!educationlevel.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete educationlevel</button>
        <!-- <button  class="btn-indigo" :loading="sending"  type="submit">Update educationlevel</button> -->
<loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update Contact</loading-button>
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
