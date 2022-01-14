<template>
    <div class="file_upload p-5 relative border-4 border-dotted border-gray-300 rounded-lg"
         :style="imageData?{ 'background-image': `url(${imageData})` }:''"
         @click="chooseImage">
        <div v-if="!imageData">
            <svg class="text-indigo-500 w-24 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
            <div class="input_field flex flex-col w-max mx-auto text-center">
                <label>
                    <div class="text bg-indigo-600 text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-indigo-500">Select</div>
                </label>
            </div>
        </div>
        <input class="text-sm cursor-pointer w-36 hidden"
              @input="onSelectFile"
              ref="fileInput"
              name="image"
              type="file">
    </div>
</template>

<script>
export default {
    name: "InputImage",
    data () {
        return {
            imageData: null
        }
    },

    methods: {
        chooseImage () {
            this.$refs.fileInput.click()
        },

        onSelectFile () {
            const input = this.$refs.fileInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.imageData = e.target.result
                }
                reader.readAsDataURL(files[0])
                this.$emit('input', files[0])
                return
            }
            this.imageData = null

        }
    }
}
</script>
