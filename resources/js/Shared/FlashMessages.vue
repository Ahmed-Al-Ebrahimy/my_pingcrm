<template>
  <div>

<transition name="slide-fade">
  <div v-if="$page.flash.success && show" class="absolute flex max-w-xs w-2/3 mt-8 mr-8 top-10 right-80 bg-green-100 rounded shadow p-1">
      <div class="mr-2">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      </div>
      <div class="flex-1 text-gray-800">
            {{ $page.flash.success }}
        </div>
       <div class="ml-2">
            <button type="button" @click="show = false" class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
       </div>
    </div>
</transition>

<transition name="slide-fade">
  <div v-if="($page.flash.error || Object.keys($page.errors).length > 0) && show" class="absolute flex max-w-xs w-full mt-4 mr-4 top-0 right-0 bg-white rounded shadow p-4">
      <div class="mr-2">
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      </div>
        <div v-if="$page.flash.error" class="flex-1 text-gray-800">
            {{ $page.flash.error }}
        </div>

        <div v-else class="flex-1 text-gray-800">
          <span v-if="Object.keys($page.errors).length === 1">There is one form error.</span>
          <span v-else>There are {{ Object.keys($page.errors).length }} form errors.</span>
        </div>
       <div class="ml-2">
            <button type="button" @click="show = false" class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
       </div>
    </div>
</transition>

  </div>
</template>

<script>
export default {
  data() {
    return {
      show: false,
    }
  },
  watch: {
    '$page.flash': {
      handler() {
        this.show = true;
        setTimeout(() => this.show = false, 2000);
      },
      deep: true,
    },
  },
}
</script>
<style>
    .slide-fade-enter-active {
        transition: all .4s ease;
    }

    .slide-fade-leave-active {
        transition: all .6s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to{
        transform: translateX(15px);
        opacity: 0;
    }
</style>
