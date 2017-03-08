<template>
    <form action="/product" method="POST">
        <input type="hidden" name="_token" :value="csrfToken">

        <div class="form-group">
            <label for="name">Product Name</label>
            <input v-model="name" type="text" class="form-control" id="name" name="name" placeholder="Product Name"
                   required>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input v-model="url" @change="removeSizes" type="text" class="form-control" id="url" name="url"
                   placeholder="URL" required>
        </div>

        <div class="form-group">
            <label for="size">Size</label>
            <select v-if="sizes.length > 0" v-model="size" class="form-control" id="size" name="size" required>
                <option v-for="size in sizes" :value="size">{{ size }}</option>
            </select>
            <button v-else @click.prevent="loadSizes" class="btn btn-block btn-primary"
                    :disabled="loading || name == '' || url == ''">
                <span v-if="loading"><i class="fa fa-spinner fa-spin"></i> Loading Sizes</span>
                <span v-else>Load Sizes</span>
            </button>
        </div>

        <div class="form-group text-right">
            <a href="/" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-success" :disabled="name == '' || url == '' || size == ''">Add
                Product
            </button>
        </div>
    </form>
</template>

<style scoped>
    /**/

</style>

<script>
    export default {
        data() {
            return {
                csrfToken: window.Laravel.csrfToken,
                name: '',
                url: '',
                size: '',
                sizes: [],
                loading: false
            }
        },

        methods: {
            loadSizes() {
                this.loading = true;

                //TODO: Load the JSON response.
                axios.post('/json/sizes', {
                    url: this.url
                  })
                  .then(response => {
                    this.sizes = response.data;
                    this.loading = false;
                  })
                  .catch(error => {
                    alert(error);
                    this.loading = false;
                  });
            },

            removeSizes() {
                this.size = '';
                this.sizes = [];
            }
        }
    }

</script>
