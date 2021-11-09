<template>
    <div>
        <h1>Editar Categoria</h1>
        <formcat 
        :category="category"
        :updating="true">
        
        </formcat>
    </div>
</template>

<script>
import FormCategoryComponent from './partials/FormCategoryComponent'


export default {
    props: {
        id: {
            require: true,
        }
    },
    created() {
        this.$store.dispatch('loadCategory', this.id)
                   .then(response => this.category = response)
                   .catch(error => {
                       console.log(error)
                   })
    },
    data () {
        return {
            category: {

            }
        }
    },
    methods: {
        loadCategory () {
            this.$store.dispatch('loadCategory', this.id)
                   .then(response => this.category = response)
                   .catch(error => {
                       this.$snotify.error('Categoria não encontrada', 'Algo deu errado!')
                       this.$router.push({name: 'admin.categories'})
                   })
        }
    },

    components: {
        formcat:FormCategoryComponent
    },
}
</script>

<style scoped>

</style>