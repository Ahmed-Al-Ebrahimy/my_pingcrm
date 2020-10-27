<template>
    <!-- <div class="max-w-sm sm:max-w-2xl md:bg-purple-800  md:max-w-xl lg:bg-pink-500 lg:max-w-6xl bg-banafsagy-600  mx-auto my-auto mt-6 p-3 pb-2  rounded shadow-md "> -->

    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  rounded sm:rounded-lg">
        <!-- <p v-if="$page.flash.message" class="text-sm">{{ $page.flash.message }}</p> -->
         <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
            <div class="flex">
            <div>
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            </div>
        </div>
        <div class="mb-2 flex justify-between">
            <!-- <button @click="focusInput()">focus</button> -->
            <div class="flex items-center ">
                <div class="flex w-full bg-white shadow rounded  ml-1">
                <input autofocus class="relative w-full border border-pink-500  focus:outline-none focus:shadow-outline focus:border-pink-400 px-1 py-1 rounded" v-model="term" autocomplete="off" type="text" id="search" placeholder="Search…">
                </div>
                <button class="ml-1 bg-indigo-800  w-1/4 border border-pink-500 outline-none px-1 py-1 shadow-md  text-gray-300 hover:bg-indigo-900 rounded-md "  @click="reset">Reset</button>
            </div>
            <div class="flex items-center  mr-1">
                <inertia-link class="border border-pink-500 bg-indigo-800  text-gray-300 px-3 py-1 shadow-md  hover:bg-indigo-900 rounded-md" :href="route('addresses.create')">
                    <span>Create Address</span>
                </inertia-link>
            </div>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="bg-banafsagy-900 text-samaee-900">
                <th class="px-2 py-1 text-sm font-bold text-left">Edit</th>
                <th class="px-2 py-1 text-sm font-bold text-left">ID</th>
                <th class="px-2 py-1 text-sm font-bold text-left">name</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="bg-banafsagy-800 text-samaee-900">
                <th class="p-2"><inertia-link v-if="addresses.prev_page_url" class="border border-pink-500 bg-banafsagy-900 hover:bg-indigo-900 text-samaee-800 shadow-2xl px-2 py-1 text-sm font-bold text-left rounded-full rounded-r-none" :href="addresses.prev_page_url">Previous Page</inertia-link>
                <inertia-link v-if="addresses.next_page_url" class="border border-pink-500 bg-banafsagy-900 hover:bg-indigo-900 text-samaee-800 shadow-2xl  px-2 py-1 text-sm font-bold text-left rounded-full rounded-l-none" :href="addresses.next_page_url"> Next Page </inertia-link></th>
                <th class="text-center">Total Rows:-  {{addresses.total}}</th>
                <th class="text-center" ></th>
            </tr>
          </tfoot>
            <tr v-for="(address, index) in addresses.data" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">
                <td class="border-t w-px ">
                    <inertia-link class="px-4 flex outline-none  items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    <icon name="edit3" class="block w-6 h-6 "/>
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.id }}
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.name }}
                    </inertia-link>
                </td>
            </tr>
            <tr v-if="addresses.data.length === 0">
                <td class="border-t px-6 py-4" colspan="4">No addresses found.</td>
            </tr>
        </table>
        </div>
        <!-- <pagination :links="addresses.links"/> -->
        <!-- <div class="mt-2">
            <inertia-link v-if="addresses.prev_page_url" class="bg-banafsagy-800 hover:bg-banafsagy-900 text-samaee-900 shadow-xl px-2 py-1 text-sm font-bold text-left rounded-full rounded-r-none"
           :href="addresses.prev_page_url">Previous Page</inertia-link>


            <inertia-link v-if="addresses.next_page_url" class="bg-banafsagy-800 hover:bg-banafsagy-900 text-samaee-900 shadow-md  px-2 py-1 text-sm font-bold text-left rounded-full rounded-l-none"
            :href="addresses.next_page_url"> Next Page </inertia-link>
        </div> -->



    </div></div></div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Icon from '@/Shared/Icon'
    import Pagination from '@/Shared/Pagination'

    import _ from 'lodash'

    export default {
        components: {
            AppLayout,
            Welcome,
            Pagination,
            Icon,
        },
        props: ['addresses', 'errors'],

        data() {
            return {
                term: '',
            }
        },
        watch: {
          term: {
            handler: _.throttle(function() {
                this.$inertia.replace(this.route('addresses', {term: this.term}))
            }, 200),
            deep: true,
            },
        },
        methods: {
            reset() {
                this.term =  null;
            },
        },

    }
</script>


