<template>
    <div>
        <label :for="id" class="block mb-2 text-sm font-medium text-white">
            <slot/>
        </label>
        <input @input="$emit('update:modelValue', $event.target.value)"
               :value="modelValue" :type="type" :id="id"
               :class="{
                           'border-red-500': errors
                       }"
               class="border sm:text-sm rounded-lg block w-full p-2.5 bg-main-700 border-main-300 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-main-500"
               :placeholder="placeholder" :required="required">
        <template v-if="showErrors && errors">
            <div v-for="error in errors" class="text-red-300 text-xs">
                {{ error }}
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "DefaultInput",
    props: {
        id: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        modelValue: {
            required: {
                required: true
            }
        },
        placeholder: String,
        required: {
            type: Boolean,
            required: false,
            default: true,
        },
        showErrors:{
          type: Boolean,
          default: true
        },
        errors: {
            type: Object,
            default: null
        },
    },
    emits: {
        'update:modelValue': null
    }
}
</script>

<style scoped>

</style>
