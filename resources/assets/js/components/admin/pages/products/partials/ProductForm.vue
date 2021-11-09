<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div :class="['form-group', {'has-error': errors.name}]" >
                <div v-if="errors.name">{{  errors.name[0] }}</div>
                <input type="text" v-model="product.name" class="form-control" placeholder="Nome do produto">
            </div>
            <div :class="['form-group', {'has-error': errors.category_id}]" >
                <div v-if="errors.category_id">{{  errors.category_id[0] }}</div>
                <select class="form-control" v-model="product.category_id">
                    <option value="">Selecione a Categoria</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
             <div :class="['form-group', {'has-error': errors.brand}]" >
                <div v-if="errors.brand">{{  errors.brand[0] }}</div>
                <input type="text" v-model="product.brand" class="form-control" placeholder="Marca do produto">
            </div>
             <div :class="['form-group', {'has-error': errors.amount}]" >
                <div v-if="errors.amount">{{  errors.amount[0] }}</div>
                <input type="text" v-model="product.amount" class="form-control" placeholder="Quantidade de produto">
            </div>
             <div :class="['form-group', {'has-error': errors.description}]" >
                <div v-if="errors.description">{{  errors.description[0] }}</div>
                <textarea v-model="product.description" cols="30" rows="10" class="form-control" placeholder="Descrição do produto"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        update: {
            require: false,
            type: Boolean,
            default: false
        },
        product: {
            require: false,
            type: Object,
            default: () =>{
                return{
                    id: '',
                    name: '',
                    description: '',
                    brand: '',
                    amount: '',
                    category_id: '',
                }
            }
        }
    },
    data () {
        return {
            errors: {}
        }
    },
    computed: {
        categories () {
            return this.$store.state.categories.items.data
        }
    },
    methods: {
        onSubmit () {
            this.$store.dispatch('storeProduct', this.product)
                       .then(() => {
                           this.$snotify.success('Sucesso ao cadastrar')

                            this.reset()

                           this.$emit('success')
                       })
                       .catch(error => {
                           this.$snotify.error('Erro ao cadastrar', 'Algo deu errado!')

                           this.errors = errors.data.errors
                       })
        },
        
        reset () {
            this.errors = {}
            this.product = {
                id: '',
                name: '',
                description: '',
                category_id: 1,
            }
        }
    }
}
</script>

<style scoped>

</style>