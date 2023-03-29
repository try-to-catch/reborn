<template>
    <div class="w-full relative">
        <input @change="$emit('update:modelValue', $event.target.value)" type="text"
               :class="[this.classes]"
               class="w-full h-8 rounded-[5px] px-2 focus:outline focus:outline-2 focus:outline-slate-600 bg-main-500"
               :placeholder="placeholder">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" :class="[this.iconClasses]"
                           class="absolute top-2 right-6 text-md text-gray-400"/>
    </div>
</template>

<script>
export default {
    name: "SearchField",
    props: {
        'modelValue': String,
        'classes': Array,
        'iconClasses': Array,
        'placeholder': {type: String, default: 'Search'},
    },
    emits: {
        'update:modelValue': (val) => typeof val === 'string'
    }
}
</script>
